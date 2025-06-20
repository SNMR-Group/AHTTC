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
$uploadDir = 'notices_pdf/';
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
            
            // Validate PDF file
            $fileType = mime_content_type($file['tmp_name']);
            if ($fileType !== 'application/pdf') {
                echo json_encode(['success' => false, 'message' => 'Only PDF files are allowed']);
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
            echo json_encode(['success' => false, 'message' => 'PDF file is required']);
            exit;
        }
        
        if (!empty($title) && !empty($filePath)) {
            $stmt = $conn->prepare("INSERT INTO all_notices (title, link, status) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $title, $filePath, $status);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Notice added successfully']);
                } else {
                    @unlink($filePath); // Remove uploaded file if DB insert fails
                    echo json_encode(['success' => false, 'message' => 'Error adding notice: ' . $conn->error]);
                }
                $stmt->close();
            } else {
                @unlink($filePath);
                echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
            }
        } else {
            @unlink($filePath);
            echo json_encode(['success' => false, 'message' => 'Title and PDF file are required']);
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
            
            // Validate PDF file
            $fileType = mime_content_type($file['tmp_name']);
            if ($fileType !== 'application/pdf') {
                echo json_encode(['success' => false, 'message' => 'Only PDF files are allowed']);
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
            $stmt = $conn->prepare("SELECT link FROM all_notices WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $oldFilePath = $row['link'];
            }
            $stmt->close();
            
            if ($filePath) {
                $stmt = $conn->prepare("UPDATE all_notices SET title = ?, link = ?, status = ? WHERE id = ?");
                $stmt->bind_param("sssi", $title, $filePath, $status, $id);
            } else {
                $stmt = $conn->prepare("UPDATE all_notices SET title = ?, status = ? WHERE id = ?");
                $stmt->bind_param("ssi", $title, $status, $id);
            }
            
            if ($stmt) {
                if ($stmt->execute()) {
                    // Delete old file if a new one was uploaded
                    if ($filePath && $oldFilePath && file_exists($oldFilePath)) {
                        @unlink($oldFilePath);
                    }
                    echo json_encode(['success' => true, 'message' => 'Notice updated successfully']);
                } else {
                    if ($filePath) @unlink($filePath); // Remove new file if update fails
                    echo json_encode(['success' => false, 'message' => 'Error updating notice: ' . $conn->error]);
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
            // Get file path to delete the PDF
            $filePath = '';
            $stmt = $conn->prepare("SELECT link FROM all_notices WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $filePath = $row['link'];
            }
            $stmt->close();
            
            $stmt = $conn->prepare("DELETE FROM all_notices WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    // Delete the PDF file
                    if ($filePath && file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    echo json_encode(['success' => true, 'message' => 'Notice deleted successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error deleting notice: ' . $conn->error]);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid notice ID']);
        }
        exit;
    }
    
    if ($action === 'toggle_status') {
        $id = intval($_POST['id'] ?? 0);
        $currentStatus = $_POST['status'] ?? '';
        $newStatus = $currentStatus === 'active' ? 'inactive' : 'active';
        
        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE all_notices SET status = ? WHERE id = ?");
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
            echo json_encode(['success' => false, 'message' => 'Invalid notice ID']);
        }
        exit;
    }
}

// Fetch all notices
$notices = [];
$error_message = '';

try {
    $sql = "SELECT id, title, link, status, created_at FROM all_notices ORDER BY created_at DESC"; 
    $result = $conn->query($sql);
    
    if ($result) {
        $notices = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error_message = "Error fetching notices: " . $conn->error;
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
    <title>All Notices Management</title>
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
        .notice-management {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .notices-table {
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

     <?php require('admin_sidebar.php') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mt-3 mb-4">All Notices Management</h1>
            
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
            <div class="notice-management">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Notices List</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoticeModal">
                        <i class="bi bi-plus-circle"></i> Add New Notice
                    </button>
                </div>
        
                <div id="alertContainer"></div>
        
                <div class="notices-table">
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
                        <tbody id="noticesTableBody">
                            <?php if (empty($notices)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <?php echo empty($error_message) ? 'No notices found' : 'Unable to load notices'; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($notices as $notice): ?>
                                    <tr data-id="<?php echo $notice['id']; ?>">
                                        <td><?php echo $notice['id']; ?></td>
                                        <td><?php echo htmlspecialchars($notice['title']); ?></td>
                                        <td>
                                            <?php if (!empty($notice['link'])): ?>
                                                <a href="<?php echo htmlspecialchars($notice['link']); ?>" target="_blank" class="text-primary">
                                                    <?php echo htmlspecialchars(basename($notice['link'])); ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">No file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge status-badge <?php echo $notice['status'] === 'active' ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo ucfirst($notice['status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($notice['created_at'])); ?></td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-warning me-1" onclick="editNotice(<?php echo $notice['id']; ?>, '<?php echo htmlspecialchars($notice['title'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($notice['link'], ENT_QUOTES); ?>', '<?php echo $notice['status']; ?>')">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                            <button class="btn btn-sm <?php echo $notice['status'] === 'active' ? 'btn-secondary' : 'btn-success'; ?> me-1" onclick="toggleStatus(<?php echo $notice['id']; ?>, '<?php echo $notice['status']; ?>')">
                                                <i class="bi bi-toggle-<?php echo $notice['status'] === 'active' ? 'off' : 'on'; ?>"></i>
                                                <?php echo $notice['status'] === 'active' ? 'Deactivate' : 'Activate'; ?>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteNotice(<?php echo $notice['id']; ?>)">
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

<!-- Add Notice Modal -->
<div class="modal fade" id="addNoticeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addNoticeForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="addTitle" name="title" placeholder="Notice Title" required>
                        <label for="addTitle">Notice Title</label>
                    </div>
                    <div class="form-floating">
                        <input type="file" class="form-control" id="addPdfFile" name="pdf_file" accept=".pdf" required>
                        <label for="addPdfFile">PDF File</label>
                        <div class="form-text">Only PDF files are allowed (max 5MB)</div>
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
                    <button type="submit" class="btn btn-primary">Add Notice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Notice Modal -->
<div class="modal fade" id="editNoticeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editNoticeForm" enctype="multipart/form-data">
                <input type="hidden" id="editId" name="id">
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="editTitle" name="title" placeholder="Notice Title" required>
                        <label for="editTitle">Notice Title</label>
                    </div>
                    <div class="mb-3">
                        <label>Current File:</label>
                        <div id="currentFileContainer" class="current-file"></div>
                    </div>
                    <div class="form-floating">
                        <input type="file" class="form-control" id="editPdfFile" name="pdf_file" accept=".pdf">
                        <label for="editPdfFile">Change PDF File (optional)</label>
                        <div class="form-text">Only PDF files are allowed (max 5MB)</div>
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
                    <button type="submit" class="btn btn-warning">Update Notice</button>
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

// Edit notice
function editNotice(id, title, link, status) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editStatus').value = status;
    
    // Display current file info
    const currentFileContainer = document.getElementById('currentFileContainer');
    if (link) {
        const fileName = link.split('/').pop();
        currentFileContainer.innerHTML = `
            <div class="file-info">
                <i class="bi bi-file-earmark-pdf"></i> ${fileName}
            </div>
            <a href="${link}" target="_blank" class="btn btn-sm btn-link">View PDF</a>
        `;
    } else {
        currentFileContainer.innerHTML = '<span class="text-muted">No file uploaded</span>';
    }
    
    new bootstrap.Modal(document.getElementById('editNoticeModal')).show();
}

// Add new notice
document.getElementById('addNoticeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'add');
    
    fetch('admin_all_notices.php', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addNoticeModal'));
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

// Edit notice form
document.getElementById('editNoticeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'edit');
    
    fetch('admin_all_notices.php', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('editNoticeModal'));
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
    if (confirm('Are you sure you want to change the status of this notice?')) {
        const formData = new FormData();
        formData.append('action', 'toggle_status');
        formData.append('id', id);
        formData.append('status', currentStatus);
        
        fetch('admin_all_notices.php', {
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

// Delete notice
function deleteNotice(id) {
    if (confirm('Are you sure you want to delete this notice? This action cannot be undone.')) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', id);
        
        fetch('admin_all_notices.php', {
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