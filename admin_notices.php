<?php
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

require 'db/db.php'; 


$notices = [];
$sql = "SELECT id, title, link FROM notices"; 
$result = $conn->query($sql);

if ($result) {
    $notices = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error fetching notices: " . $conn->error;
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .notice-board {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .notice-board h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .notice-wrapper {
            max-height: 300px;
            overflow-y: auto;
        }
        .notice-wrapper ul {
            list-style: none;
            padding: 0;
        }
        .notice-wrapper li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .btn-primary {
            margin-top: 10px;
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
                <li class="d-flex align-items-center">
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
                <li class="d-flex align-items-center active" data-page="admin_notices.php">
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

    <h1 class="text-center mt-5">Manage your notices here</h1>
    <div class="notice-board">
        <h2 class="mt-4">Top Notice</h2>
        <div id="top-notice">
            <form id="top-notice-form">
                <div class="form-group">
                    <label for="top-notice-message">Message</label>
                    <textarea class="form-control" id="top-notice-message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Top Notice</button>
            </form>
        </div>
        <br><br>
        <h1>Manage Your Notices Here</h1>
        <div class="ribbon">Notice Board</div>
        <div class="notice-wrapper">
            <ul id="notice-list">
                <?php foreach ($notices as $notice): ?>
                    <li class="ml-5">
                        Notice: <?php echo htmlspecialchars($notice['title']); ?> 
                        <a href="<?php echo htmlspecialchars($notice['link']); ?>" target="_blank">Link</a>
                        <a href="#" class="btn btn-warning btn-sm ms-2" onclick="showEditForm(<?php echo $notice['id']; ?>, '<?php echo htmlspecialchars($notice['title']); ?>', '<?php echo htmlspecialchars($notice['link']); ?>')">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm ms-2" onclick="deleteNotice(<?php echo $notice['id']; ?>)">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <h2 class="mt-4">Add New Notice</h2>
        <form id="notice-form">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="url" class="form-control" id="link" name="link" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Notice</button>
        </form>
    </div>
</div>

<script src="js/manage_notice.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
