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

require 'db/db.php'; // Your DB connection here

// Handle image upload and return the path or null on failure
function handleImageUpload($image)
{
    $target_dir = "images/uploads/";
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

 
    $check = getimagesize($image["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

   
    if ($image["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

  
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      
    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            return null;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_teacher'])) {
        $name = $_POST['name'];
        $position = $_POST['position'];
        $description = $_POST['description'];
        $image_path = handleImageUpload($_FILES['image']);

        $sql = "INSERT INTO non_teaching_staff (name, position, description, image_path) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $position, $description, $image_path);
        $stmt->execute();
    } elseif (isset($_POST['edit_teacher'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $description = $_POST['description'];
        $image_path = $_FILES['image']['name'] ? handleImageUpload($_FILES['image']) : $_POST['existing_image'];

        $sql = "UPDATE teachers SET name = ?, position = ?, description = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $position, $description, $image_path, $id);
        $stmt->execute();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_teacher'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM non_teaching_staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}


$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
  <?php require('admin_sidebar.php') ?>

    <div class="container">

        <h1 class="text-center mt-5">Manage Non Teaching Staffs</h1>

        
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="teacherId">
            <input type="hidden" name="existing_image" id="existingImage">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" name="add_teacher" class="btn btn-primary">Add Staffs</button>
            <button type="submit" name="edit_teacher" class="btn btn-warning" style="display:none;">Edit Teacher</button>
        </form>

      
        <h2 class="mt-5">Teachers List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'db/db.php';
                $sql = "SELECT id, name, position, description, image_path FROM non_teaching_staff";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Image' style='width:100px;'></td>";
                        echo "<td>";
                        echo "<button class='btn btn-info edit-btn' 
                        data-id='" . htmlspecialchars($row['id']) . "'
                        data-name='" . htmlspecialchars($row['name']) . "'
                        data-position='" . htmlspecialchars($row['position']) . "'
                        data-description='" . htmlspecialchars($row['description']) . "'
                        data-image='" . htmlspecialchars($row['image_path']) . "'>Edit</button>";
                        echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit' name='delete_teacher' class='btn btn-danger'>Delete</button>
                          </form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No teachers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('teacherId').value = this.getAttribute('data-id');
                    document.getElementById('name').value = this.getAttribute('data-name');
                    document.getElementById('position').value = this.getAttribute('data-position');
                    document.getElementById('description').value = this.getAttribute('data-description');
                    document.getElementById('existingImage').value = this.getAttribute('data-image');
                    document.querySelector('[name="add_teacher"]').style.display = 'none';
                    document.querySelector('[name="edit_teacher"]').style.display = 'inline-block';
                });
            });
        });

        function handleImageUpload($image) {
            $target_dir = "images/uploads/";
            $target_file = $target_dir.basename($image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $uploadOk = 1;

           
            $check = getimagesize($image["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

          
            if ($image["size"] > 1000000) { // 1 MB = 1,000,000 bytes
                echo "Sorry, your file is too large. Maximum size is 1 MB.";
                $uploadOk = 0;
            }

            
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" &&
                $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

           
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
               
            } else {
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return null;
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
