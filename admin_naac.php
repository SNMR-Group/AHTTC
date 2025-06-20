<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}


require "db/db.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    
    $success_message = $error_message = '';

    if ($action === 'update_url') {
       
        $id = $_POST['id'];
        $url = $_POST['url'];

        $update_sql = "UPDATE naac SET url = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $url, $id);

        if ($stmt->execute()) {
            $success_message = "URL updated successfully!";
        } else {
            $error_message = "Error updating URL!";
        }
    } elseif ($action === 'update_title') {
      
        $id = $_POST['id'];
        $title = $_POST['title'];

        $update_sql = "UPDATE naac SET title = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $title, $id);

        if ($stmt->execute()) {
            $success_message = "Title updated successfully!";
        } else {
            $error_message = "Error updating title!";
        }
    } elseif ($action === 'update_multiple') {
        
        $id = $_POST['id'];
        $title = $_POST['title'];
        $url = $_POST['url'];

        $update_sql = "UPDATE naac SET title = ?, url = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $title, $url, $id);

        if ($stmt->execute()) {
            $success_message = "Record updated successfully!";
        } else {
            $error_message = "Error updating record!";
        }
    } else {
        $error_message = "Invalid action!";
    }
}


$sql = "SELECT id, title, url FROM naac";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage NAAC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
  <?php require('admin_sidebar.php') ?>
<div class="container mt-5">
    <h2 class="mb-4">Update NAAC URL</h2>

    <!-- Success/Error Messages -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Display AISHE Records -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td>" . htmlspecialchars($row['url']) . "</td>
                        <td>
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Update URL</button>
                        </td>
                      </tr>";

                echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Update AISHE URL</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <form method='POST' action=''>
                                    <input type='hidden' name='action' value='update_url'>
                                    <div class='modal-body'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <div class='mb-3'>
                                            <label for='url" . $row['id'] . "' class='form-label'>New URL</label>
                                            <input type='url' class='form-control' id='url" . $row['id'] . "' name='url' value='" . htmlspecialchars($row['url']) . "' required>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
