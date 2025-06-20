<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}

require "db/db.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
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
                <li class="d-flex align-items-center active" data-page="admin_gallery.php">
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

        <div class="container">
            <h1 class="text-center mt-5">Welcome to the Admin Page, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        </div>

        <div class="container mt-5">
            <h2>Manage Gallery</h2>
            <form action="gallery_manage.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label for="image" class="form-label">Add New Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>

            <h2 class="mt-5">Gallery Images</h2>
            <div class="row">
                <?php
                require "db/db.php";
                $sql = "SELECT * FROM gallery_images";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3">
                            <div class="card mb-4">
                                <img src="' . $row['image_path'] . '" class="card-img-top" alt="Image">
                                <div class="card-body">
                                    <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                                    <form action="gallery_manage.php" method="GET">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="' . $row['id'] . '">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <form action="gallery_manage.php" method="POST" class="mt-2">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="' . $row['id'] . '">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="description" value="' . htmlspecialchars($row['description']) . '" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                          </div>';
                    }
                } else {
                    echo "No images found.";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const menuItems = document.querySelectorAll('.side-menu li');

            menuItems.forEach(item => {
                if (item.getAttribute('data-page') === currentPage) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>