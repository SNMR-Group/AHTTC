<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

require 'db/db.php';

// Create uploads directory if it doesn't exist
if (!file_exists('uploads/notices')) {
    mkdir('uploads/notices', 0777, true);
}

$itemsPerPage = 5; 
$currentPage = isset($_GET['noticesPage']) ? (int)$_GET['noticesPage'] : 1;
if ($currentPage < 1) $currentPage = 1;
$offset = ($currentPage - 1) * $itemsPerPage;

$totalNoticesQuery = "SELECT COUNT(*) AS total FROM extra_notice";
$stmt = $conn->prepare($totalNoticesQuery);
$stmt->execute();
$totalNoticesResult = $stmt->get_result();
$totalNotices = $totalNoticesResult->fetch_assoc()['total'];
$totalPagesNotices = ceil($totalNotices / $itemsPerPage);

$noticesQuery = "SELECT id, title, category, pdf_filename, created_at FROM extra_notice ORDER BY created_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($noticesQuery);
$stmt->bind_param("ii", $itemsPerPage, $offset);
$stmt->execute();
$noticesResult = $stmt->get_result();
$notices = $noticesResult->fetch_all(MYSQLI_ASSOC);

if (isset($_GET['delete_id'])) {
    $noticeId = (int)$_GET['delete_id'];
    
    // Get filename first
    $getFileQuery = "SELECT pdf_filename FROM extra_notice WHERE id = ?";
    $stmt = $conn->prepare($getFileQuery);
    $stmt->bind_param("i", $noticeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $filename = $result->fetch_assoc()['pdf_filename'];
    
    $deleteQuery = "DELETE FROM extra_notice WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $noticeId);
    
    if ($stmt->execute()) {
        // Delete associated file
        if ($filename && file_exists("uploads/notices/$filename")) {
            unlink("uploads/notices/$filename");
        }
        echo "<script>alert('Notice deleted successfully.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "Error deleting notice: " . $conn->error;
    }
    exit;
}

$noticeData = null; 
if (isset($_GET['edit_id'])) {
    $editId = (int)$_GET['edit_id'];
    $noticeQuery = "SELECT * FROM extra_notice WHERE id = ?";
    $stmt = $conn->prepare($noticeQuery);
    $stmt->bind_param("i", $editId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $noticeData = $result->fetch_assoc();
    } else {
        echo "Notice not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $pdfFilename = null;

    // Handle file upload
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['application/pdf'];
        $fileType = $_FILES['pdf_file']['type'];
        
        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('Error: Only PDF files are allowed.');</script>";
        } else {
            $extension = pathinfo($_FILES['pdf_file']['name'], PATHINFO_EXTENSION);
            $pdfFilename = uniqid() . '.' . $extension;
            $destination = 'uploads/notices/' . $pdfFilename;
            
            if (!move_uploaded_file($_FILES['pdf_file']['tmp_name'], $destination)) {
                echo "<script>alert('Error uploading file.');</script>";
                $pdfFilename = null;
            }
        }
    }

    if (isset($_POST['add'])) {
        $createdAt = date('Y-m-d H:i:s'); 
        $insertQuery = "INSERT INTO extra_notice (title, category, pdf_filename, created_at) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $title, $category, $pdfFilename, $createdAt);
        if ($stmt->execute()) {
            echo "<script>alert('Notice added successfully.'); window.location.href = 'admin.php';</script>";
        } else {
            echo "Error adding notice: " . $conn->error;
        }
    } elseif (isset($_POST['save'])) {
        $noticeId = (int)$_POST['id'];
        
        // If new file uploaded, get old filename for deletion
        $oldFilename = null;
        if ($pdfFilename) {
            $getFileQuery = "SELECT pdf_filename FROM extra_notice WHERE id = ?";
            $stmt = $conn->prepare($getFileQuery);
            $stmt->bind_param("i", $noticeId);
            $stmt->execute();
            $result = $stmt->get_result();
            $oldFilename = $result->fetch_assoc()['pdf_filename'];
        }
        
        if ($pdfFilename) {
            $updateQuery = "UPDATE extra_notice SET title = ?, category = ?, pdf_filename = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sssi", $title, $category, $pdfFilename, $noticeId);
        } else {
            $updateQuery = "UPDATE extra_notice SET title = ?, category = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssi", $title, $category, $noticeId);
        }
        
        if ($stmt->execute()) {
            // Delete old file after successful update
            if ($oldFilename && file_exists("uploads/notices/$oldFilename")) {
                unlink("uploads/notices/$oldFilename");
            }
            echo "<script>alert('Notice updated successfully.'); window.location.href = 'admin.php';</script>";
        } else {
            echo "Error updating notice: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .container {
            margin-top: 20px;
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .btn-primary {
            margin-top: 10px;
        }
        
        .table-wrapper {
            margin-top: 30px;
        }
        
        .table th,
        .table td {
            vertical-align: middle;
        }
        
        .section {
            margin-bottom: 30px;
            padding: 25px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .section h2 {
            margin-bottom: 25px;
            color: #2c3e50;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
        }
        
        .file-upload-container {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            background: #f9f9f9;
            transition: all 0.3s;
        }
        
        .file-upload-container:hover {
            border-color: #4361ee;
            background: #f0f5ff;
        }
        
        .file-upload-container i {
            font-size: 48px;
            color: #4361ee;
            margin-bottom: 15px;
        }
        
        .btn-view-pdf {
            background: #e3f2fd;
            color: #1976d2;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-view-pdf:hover {
            background: #bbdefb;
            text-decoration: none;
        }
        
        .category-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .badge-examination {
            background: #ffebee;
            color: #c62828;
        }
        
        .badge-admission {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .badge-event {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .badge-update {
            background: #fff8e1;
            color: #f57f17;
        }
        
        .action-btn {
            padding: 6px 12px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .pagination .page-link {
            border-radius: 5px;
            margin: 0 3px;
        }
        
        .stats-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        
        .stats-card .number {
            font-size: 24px;
            font-weight: 700;
            color: #4361ee;
            margin-bottom: 5px;
        }
        
        .stats-card .label {
            font-size: 14px;
            color: #6c757d;
            text-transform: uppercase;
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
                <li class="d-flex align-items-center  active">
                    <img src="images/admin_images/1.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Dashboard</span>
                </li>
            </a>
            <a style="color:white;" href="admin_gallery.php">
                <li class="d-flex align-items-center" data-page="admin_gallery.php">
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
                <li class="d-flex align-items-center" data-page="admin_download.php">
                    <img src="images/admin_images/7.png" alt="Al-Habeeb Teacher Training College" class="me-2">
                    <span class="d-none d-sm-inline">Download Documents</span>
                </li>
            </a>
        </ul>
        <a style="" href="admin.php?logout=true" class="btn btn-danger logout-button">Logout</a></span>
    </div>

    <div class="container">
        <h1 class="text-center mt-5 mb-4">Manage Examination and Admission Notices</h1>
        
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="number"><?php echo $totalNotices; ?></div>
                    <div class="label">Total Notices</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="number"><?php echo $totalPagesNotices; ?></div>
                    <div class="label">Total Pages</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="number"><?php echo $currentPage; ?></div>
                    <div class="label">Current Page</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="number"><?php echo $itemsPerPage; ?></div>
                    <div class="label">Items Per Page</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-file-alt me-2"></i> Notices</h2>

            <div class="mb-4">
                <form method="POST" action="admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo isset($noticeData['id']) ? htmlspecialchars($noticeData['id']) : ''; ?>">

                    <div class="mb-3">
                        <label for="notice-title" class="form-label">Title</label>
                        <input type="text"
                            class="form-control"
                            id="notice-title"
                            name="title"
                            value="<?php echo isset($noticeData['title']) ? htmlspecialchars($noticeData['title']) : ''; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="notice-category" class="form-label">Category</label>
                        <select class="form-select" id="notice-category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="examination" <?php echo isset($noticeData['category']) && $noticeData['category'] === 'examination' ? 'selected' : ''; ?>>Examination</option>
                            <option value="admission" <?php echo isset($noticeData['category']) && $noticeData['category'] === 'admission' ? 'selected' : ''; ?>>Admission</option>
                            <option value="event" <?php echo isset($noticeData['category']) && $noticeData['category'] === 'event' ? 'selected' : ''; ?>>Event</option>
                            <option value="update" <?php echo isset($noticeData['category']) && $noticeData['category'] === 'update' ? 'selected' : ''; ?>>Update</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="pdf_file" class="form-label">PDF File</label>
                        
                        <?php if (isset($noticeData) && !empty($noticeData['pdf_filename'])): ?>
                            <div class="mb-3">
                                <p class="mb-1">Current file:</p>
                                <a href="uploads/notices/<?php echo htmlspecialchars($noticeData['pdf_filename']); ?>" 
                                   target="_blank" class="btn-view-pdf">
                                    <i class="fas fa-file-pdf me-1"></i> <?php echo htmlspecialchars($noticeData['pdf_filename']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="file-upload-container">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h5>Upload PDF File</h5>
                            <p class="text-muted">Drag & drop your file here or click to browse</p>
                            <input type="file" class="form-control" id="pdf_file" name="pdf_file" 
                                   accept=".pdf" <?php echo !isset($noticeData) ? 'required' : ''; ?>>
                            <div class="form-text mt-2">
                                <?php echo isset($noticeData) ? 'Upload new file to replace existing' : 'Only PDF files accepted (max 5MB)'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="<?php echo isset($noticeData) ? 'save' : 'add'; ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            <?php echo isset($noticeData) ? 'Save Changes' : 'Add Notice'; ?>
                        </button>
                        
                        <?php if (isset($noticeData)): ?>
                            <a href="admin.php" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Cancel Edit
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>PDF File</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($notices)): ?>
                            <?php foreach ($notices as $row): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td>
                                        <span class="category-badge badge-<?php echo htmlspecialchars($row['category']); ?>">
                                            <?php echo ucfirst(htmlspecialchars($row['category'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($row['pdf_filename'])): ?>
                                            <a href="uploads/notices/<?php echo htmlspecialchars($row['pdf_filename']); ?>" 
                                               target="_blank" class="btn-view-pdf">
                                                <i class="fas fa-file-pdf me-1"></i> View PDF
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No file</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="?edit_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning action-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Are you sure you want to delete this notice?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox me-2" style="font-size: 3rem; color: #6c757d;"></i>
                                    <h5 class="mt-2">No notices found</h5>
                                    <p>Add your first notice using the form above</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?noticesPage=<?php echo $currentPage - 1; ?>">
                                <i class="fas fa-angle-left me-1"></i> Previous
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPagesNotices; $i++): ?>
                        <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="?noticesPage=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPagesNotices): ?>
                        <li class="page-item">
                            <a class="page-link" href="?noticesPage=<?php echo $currentPage + 1; ?>">
                                Next <i class="fas fa-angle-right ms-1"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // File upload feedback
        document.getElementById('pdf_file').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.querySelector('.file-upload-container h5').textContent = fileName;
            document.querySelector('.file-upload-container p').textContent = 'Ready to upload';
            document.querySelector('.file-upload-container').style.borderColor = '#28a745';
            document.querySelector('.file-upload-container').style.backgroundColor = '#e8f5e9';
        });
        
        // Confirm before delete
        document.querySelectorAll('.btn-danger').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this notice? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
