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


$noticesQuery = "SELECT id, title, category, link, created_at FROM extra_notice ORDER BY created_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($noticesQuery);
$stmt->bind_param("ii", $itemsPerPage, $offset);
$stmt->execute();
$noticesResult = $stmt->get_result();
$notices = $noticesResult->fetch_all(MYSQLI_ASSOC);


if (isset($_GET['delete_id'])) {
    $noticeId = (int)$_GET['delete_id'];
    $deleteQuery = "DELETE FROM extra_notice WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $noticeId);
    if ($stmt->execute()) {
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
    $link = $_POST['link'];

    if (isset($_POST['add'])) {
        $createdAt = date('Y-m-d H:i:s'); 
        $insertQuery = "INSERT INTO extra_notice (title, category, link, created_at) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $title, $category, $link, $createdAt);
        if ($stmt->execute()) {
            echo "<script>alert('Notice added successfully.'); window.location.href = 'admin.php';</script>";
        } else {
            echo "Error adding notice: " . $conn->error;
        }
    } elseif (isset($_POST['save'])) {
        $noticeId = (int)$_POST['id'];
        $updateQuery = "UPDATE extra_notice SET title = ?, category = ?, link = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssi", $title, $category, $link, $noticeId);
        if ($stmt->execute()) {
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
    <title>Manage Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .container {
            margin-top: 20px;
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
            text-align: center;
        }

        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .section h2 {
            margin-bottom: 20px;
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
        <h1 class="text-center mt-5">Manage Examination and Admission Notices</h1>

        <div class="section">
            <h2>Notices</h2>

            <div class="mb-3">
                <form method="POST" action="admin.php">
                    <input type="hidden" name="id" value="<?php echo isset($noticeData['id']) ? htmlspecialchars($noticeData['id']) : ''; ?>">

                    <div class="form-group">
                        <label for="notice-title">Title</label>
                        <input type="text"
                            class="form-control"
                            id="notice-title"
                            name="title"
                            value="<?php echo isset($noticeData['title']) ? htmlspecialchars($noticeData['title']) : ''; ?>"
                            required>
                    </div>

                
                    <div class="form-group">
                        <label for="notice-category">Category</label>
                        <select class="form-control" id="notice-category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="examination" <?php echo isset($noticeData['category']) && $noticeData['category'] === 'Event' ? 'selected' : ''; ?>>Examination</option>
                            <option value="admission" <?php echo isset($noticeData['category']) && $noticeData['category'] === 'Update' ? 'selected' : ''; ?>>Admission</option>
                        </select>
                    </div>

                
                    <div class="form-group">
                        <label for="notice-link">Link </label>
                        <input type="url"
                            class="form-control"
                            id="notice-link"
                            name="link"
                            value="<?php echo isset($noticeData['link']) ? htmlspecialchars($noticeData['link']) : ''; ?>"
                            placeholder="Google Drive Link">
                    </div>

                  
                    <button type="submit" name="<?php echo isset($noticeData) ? 'save' : 'add'; ?>" class="btn btn-primary mt-2">
                        <?php echo isset($noticeData) ? 'Save Changes' : 'Add Notice'; ?>
                    </button>
                </form>
            </div>

          
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Link</th>
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
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td>
                                    <?php if (!empty($row['link'])): ?>
                                        <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank">See Link</a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <a href="?edit_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this notice?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No notices found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

           
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?noticesPage=<?php echo $currentPage - 1; ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php if ($currentPage < $totalPagesNotices): ?>
                        <li class="page-item">
                            <a class="page-link" href="?noticesPage=<?php echo $currentPage + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>



</body>

</html>