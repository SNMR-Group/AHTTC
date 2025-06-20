<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}


require "db/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $target_dir = "images/gallery/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $description = $_POST['description'];

        
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                $sql = "INSERT INTO gallery_images (image_path, description) VALUES ('$target_file', '$description')";
                if ($conn->query($sql) === TRUE) {
                    header("location:admin_gallery.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $description = $_POST['description'];

        
        $sql = "UPDATE gallery_images SET description='$description' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("location:admin_gallery.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT image_path FROM gallery_images WHERE id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image_path = $row['image_path'];
            if (file_exists($image_path) && unlink($image_path)) {
                $sql = "DELETE FROM gallery_images WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    header("location:admin_gallery.php");
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error deleting file.";
            }
        } else {
            echo "Record not found.";
        }
    }
}


$conn->close();
?>
