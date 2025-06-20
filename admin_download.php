<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);

// Include database connection
try {
    require 'db/db.php';
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// PDF upload directory
$uploadDir = 'downloads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $status = $_POST['status'] ?? 'active';
        
        // Handle file upload
        $filePath = '';
        if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['pdf_file'];
            
            // Validate file
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $fileType = mime_content_type($file['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                echo json_encode(['success' => false, 'message' => 'Only PDF and Word documents are allowed']);
                exit;
            }
            
            // Generate unique filename
            $fileName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9\.]/", "_", $file['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            } else {
                echo json_encode(['success' => false, 'message' => 'File upload failed']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Document file is required']);
            exit;
        }
        
        if (!empty($title) && !empty($filePath)) {
            $stmt = $conn->prepare("INSERT INTO downloadable_docs (title, file_path, status) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $title, $filePath, $status);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Document added successfully']);
                } else {
                    @unlink($filePath); // Remove uploaded file if DB insert fails
                    echo json_encode(['success' => false, 'message' => 'Error adding document: ' . $conn->error]);
                }
                $stmt->close();
            } else {
                @unlink($filePath);
                echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
            }
        } else {
            @unlink($filePath);
            echo json_encode(['success' => false, 'message' => 'Title and document file are required']);
        }
        exit;
    }
    
    if ($action === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $status = $_POST['status'] ?? 'active';
        $filePath = null;
        
        // Handle file upload if provided
        if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['pdf_file'];
            
            // Validate file
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $fileType = mime_content_type($file['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                echo json_encode(['success' => false, 'message' => 'Only PDF and Word documents are allowed']);
                exit;
            }
            
            // Generate unique filename
            $fileName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9\.]/", "_", $file['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            } else {
                echo json_encode(['success' => false, 'message' => 'File upload failed']);
                exit;
            }
        }
        
        if (!empty($title) && $id > 0) {
            // Get current file path to delete old file if needed
            $oldFilePath = '';
            $stmt = $conn->prepare("SELECT file_path FROM downloadable_docs WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $oldFilePath = $row['file_path'];
            }
            $stmt->close();
            
            if ($filePath) {
                $stmt = $conn->prepare("UPDATE downloadable_docs SET title = ?, file_path = ?, status = ? WHERE id = ?");
                $stmt->bind_param("sssi", $title, $filePath, $status, $id);
            } else {
                $stmt = $conn->prepare("UPDATE downloadable_docs SET title = ?, status = ? WHERE id = ?");
                $stmt->bind_param("ssi", $title, $status, $id);
            }
            
            if ($stmt) {
                if ($stmt->execute()) {
                    // Delete old file if a new one was uploaded
                    if ($filePath && $oldFilePath && file_exists($oldFilePath)) {
                        @unlink($oldFilePath);
                    }
                    echo json_encode(['success' => true, 'message' => 'Document updated successfully']);
                } else {
                    if ($filePath) @unlink($filePath); // Remove new file if update fails
                    echo json_encode(['success' => false, 'message' => 'Error updating document: ' . $conn->error]);
                }
                $stmt->close();
            } else {
                if ($filePath) @unlink($filePath);
                echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
        }
        exit;
    }
    
    if ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        
        if ($id > 0) {
            // Get file path to delete the document
            $filePath = '';
            $stmt = $conn->prepare("SELECT file_path FROM downloadable_docs WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $filePath = $row['file_path'];
            }
            $stmt->close();
            
            $stmt = $conn->prepare("DELETE FROM downloadable_docs WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    // Delete the document file
                    if ($filePath && file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    echo json_encode(['success' => true, 'message' => 'Document deleted successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error deleting document: ' . $conn->error]);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid document ID']);
        }
        exit;
    }
    
    if ($action === 'toggle_status') {
        $id = intval($_POST['id'] ?? 0);
        $currentStatus = $_POST['status'] ?? '';
        $newStatus = $currentStatus === 'active' ? 'inactive' : 'active';
        
        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE downloadable_docs SET status = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("si", $newStatus, $id);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Status updated successfully', 'new_status' => $newStatus]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error updating status: ' . $conn->error]);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid document ID']);
        }
        exit;
    }
}

// Fetch all documents
$documents = [];
$error_message = '';

try {
    $sql = "SELECT id, title, file_path, status, created_at FROM downloadable_docs ORDER BY created_at DESC"; 
    $result = $conn->query($sql);
    
    if ($result) {
        $documents = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error_message = "Error fetching documents: " . $conn->error;
    }
} catch (Exception $e) {
    $error_message = "Database error: " . $e->getMessage();
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Downloads Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .container-fluid {
            margin-top: 20px;
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .documents-management {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .documents-table {
            max-height: 500px;
            overflow-y: auto;
        }
        .status-badge {
            font-size: 0.75rem;
        }
        .action-buttons {
            white-space: nowrap;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .alert {
            margin-top: 15px;
        }
        .table th {
            background-color: #e9ecef;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .form-floating {
            margin-bottom: 15px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .current-file {
            margin-top: 10px;
            font-size: 0.9rem;
        }
        .file-info {
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .container-fluid {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
        }
    </style>
</head>
<body>

     <div class="side-menu overflow-scroll">
        <div class="brand-name">
            <h1 class="text-light">Menu items</h1>
        </div>
        <ul class="text-center ">
            <a style="color:white;" href="admin.php">
                <li class="d-flex align-items-center ">
                    <img src="images/admin_images/1.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Dashboard</span>
                </li>
            </a>
            <a style="color:white;" href="admin_gallery.php">
                <li class="d-flex align-items-center " data-page="admin_gallery.php">
                    <img src="images/admin_images/2.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Gallery</span>
                </li>
            </a>
              <a style="color:white;" href="admin_event_gallery.php">
                <li class="d-flex align-items-center" data-page="admin_event_gallery.php">
                    <img src="images/admin_images/2.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Event Gallery</span>
                </li>
            </a>
            <a style="color:white;" href="admin_notices.php">
                <li class="d-flex align-items-center" data-page="admin_notices.php">
                    <img src="images/admin_images/3.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Notice</span>
                </li>
            </a>
              <a style="color:white;" href="admin_all_notices.php">
                <li class="d-flex align-items-center" data-page="admin_notices.php">
                    <img src="images/admin_images/3.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">All Notices</span>
                </li>
            </a>
               <a style="color:white;" href="admin_teaching.php">
                <li class="d-flex align-items-center" data-page="admin_faculty.php">
                    <img src="images/admin_images/4.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Teaching Staffs</span>
                </li>
            </a>
            <a style="color:white;" href="admin_non_teaching.php">
                <li class="d-flex align-items-center" data-page="admin_faculty.php">
                    <img src="images/admin_images/4.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Non Teaching Staffs</span>
                </li>
            </a>
            <a style="color:white;" href="admin_ebook.php">
                <li class="d-flex align-items-center" data-page="admin_faculty.php">
                    <img src="images/admin_images/4.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">E-book</span>
                </li>
            </a>
            <a style="color:white;" href="admin_syllabus.php">
                <li class="d-flex align-items-center" data-page="admin_syllabus.php">
                    <img src="images/admin_images/7.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">syllabus</span>
                </li>
            </a>
            <a style="color:white;" href="admin_naac.php">
                <li class="d-flex align-items-center" data-page="admin_naac.php">
                    <img src="images/admin_images/7.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">naac</span>
                </li>
            </a>
            <a style="color:white;" href="admin_download.php">
                <li class="d-flex align-items-center active" data-page="admin_download.php">
                    <img src="images/admin_images/7.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Download Documents</span>
                </li>
            </a>
        </ul>
        <a style="" href="admin.php?logout=true" class="btn btn-danger logout-button">Logout</a></span>
    </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mt-3 mb-4">Downloads Management</h1>
            
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
            <div class="documents-management">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Documents List</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
                        <i class="bi bi-plus-circle"></i> Add New Document
                    </button>
                </div>
        
                <div id="alertContainer"></div>
        
                <div class="documents-table">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="documentsTableBody">
                            <?php if (empty($documents)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <?php echo empty($error_message) ? 'No documents found' : 'Unable to load documents'; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($documents as $document): ?>
                                    <tr data-id="<?php echo $document['id']; ?>">
                                        <td><?php echo $document['id']; ?></td>
                                        <td><?php echo htmlspecialchars($document['title']); ?></td>
                                        <td>
                                            <?php if (!empty($document['file_path'])): ?>
                                                <a href="<?php echo htmlspecialchars($document['file_path']); ?>" target="_blank" class="text-primary">
                                                    <?php echo htmlspecialchars(basename($document['file_path'])); ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">No file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge status-badge <?php echo $document['status'] === 'active' ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo ucfirst($document['status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($document['created_at'])); ?></td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-warning me-1" onclick="editDocument(<?php echo $document['id']; ?>, '<?php echo htmlspecialchars($document['title'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($document['file_path'], ENT_QUOTES); ?>', '<?php echo $document['status']; ?>')">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                            <button class="btn btn-sm <?php echo $document['status'] === 'active' ? 'btn-secondary' : 'btn-success'; ?> me-1" onclick="toggleStatus(<?php echo $document['id']; ?>, '<?php echo $document['status']; ?>')">
                                                <i class="bi bi-toggle-<?php echo $document['status'] === 'active' ? 'off' : 'on'; ?>"></i>
                                                <?php echo $document['status'] === 'active' ? 'Deactivate' : 'Activate'; ?>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteDocument(<?php echo $document['id']; ?>)">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Document Modal -->
<div class="modal fade" id="addDocumentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addDocumentForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="addTitle" name="title" placeholder="Document Title" required>
                        <label for="addTitle">Document Title</label>
                    </div>
                    <div class="form-floating">
                        <input type="file" class="form-control" id="addPdfFile" name="pdf_file" accept=".pdf,.doc,.docx" required>
                        <label for="addPdfFile">Document File</label>
                        <div class="form-text">Only PDF and Word documents are allowed (max 5MB)</div>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="addStatus" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <label for="addStatus">Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Document</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Document Modal -->
<div class="modal fade" id="editDocumentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editDocumentForm" enctype="multipart/form-data">
                <input type="hidden" id="editId" name="id">
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="editTitle" name="title" placeholder="Document Title" required>
                        <label for="editTitle">Document Title</label>
                    </div>
                    <div class="mb-3">
                        <label>Current File:</label>
                        <div id="currentFileContainer" class="current-file"></div>
                    </div>
                    <div class="form-floating">
                        <input type="file" class="form-control" id="editPdfFile" name="pdf_file" accept=".pdf,.doc,.docx">
                        <label for="editPdfFile">Change Document File (optional)</label>
                        <div class="form-text">Only PDF and Word documents are allowed (max 5MB)</div>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="editStatus" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <label for="editStatus">Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Document</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Show alert messages
function showAlert(message, type = 'success') {
    const alertContainer = document.getElementById('alertContainer');
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    alertContainer.innerHTML = alertHtml;
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        const alert = alertContainer.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}

// Edit document
function editDocument(id, title, link, status) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editStatus').value = status;
    
    // Display current file info
    const currentFileContainer = document.getElementById('currentFileContainer');
    if (link) {
        const fileName = link.split('/').pop();
        currentFileContainer.innerHTML = `
            <div class="file-info">
                <i class="bi bi-file-earmark"></i> ${fileName}
            </div>
            <a href="${link}" target="_blank" class="btn btn-sm btn-link">View File</a>
        `;
    } else {
        currentFileContainer.innerHTML = '<span class="text-muted">No file uploaded</span>';
    }
    
    new bootstrap.Modal(document.getElementById('editDocumentModal')).show();
}

// Add new document
document.getElementById('addDocumentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'add');
    
    fetch('admin_download.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('addDocumentModal'));
            if (modal) modal.hide();
            this.reset();
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(data.message, 'danger');
        }
    })
    .catch(error => {
        showAlert('An error occurred: ' + error.message, 'danger');
        console.error('Error:', error);
    });
});

// Edit document form
document.getElementById('editDocumentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'edit');
    
    fetch('admin_download.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('editDocumentModal'));
            if (modal) modal.hide();
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(data.message, 'danger');
        }
    })
    .catch(error => {
        showAlert('An error occurred: ' + error.message, 'danger');
        console.error('Error:', error);
    });
});

// Toggle status
function toggleStatus(id, currentStatus) {
    if (confirm('Are you sure you want to change the status of this document?')) {
        const formData = new FormData();
        formData.append('action', 'toggle_status');
        formData.append('id', id);
        formData.append('status', currentStatus);
        
        fetch('admin_download.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            showAlert('An error occurred: ' + error.message, 'danger');
            console.error('Error:', error);
        });
    }
}

// Delete document
function deleteDocument(id) {
    if (confirm('Are you sure you want to delete this document? This action cannot be undone.')) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', id);
        
        fetch('admin_download.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            showAlert('An error occurred: ' + error.message, 'danger');
            console.error('Error:', error);
        });
    }
}
</script>

</body>
</html>