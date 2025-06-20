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
$currentPage = isset($_GET['syllabusPage']) ? (int)$_GET['syllabusPage'] : 1;
if ($currentPage < 1) $currentPage = 1;
$offset = ($currentPage - 1) * $itemsPerPage;

$totalSyllabusQuery = "SELECT COUNT(*) AS total FROM syllabus";
$stmt = $conn->prepare($totalSyllabusQuery);
$stmt->execute();
$totalSyllabusResult = $stmt->get_result();
$totalSyllabus = $totalSyllabusResult->fetch_assoc()['total'];
$totalPagesSyllabus = ceil($totalSyllabus / $itemsPerPage);


$syllabus = [];
$syllabusQuery = "SELECT id, title, link FROM syllabus ORDER BY id DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($syllabusQuery);
$stmt->bind_param("ii", $itemsPerPage, $offset);
$stmt->execute();
$syllabusResult = $stmt->get_result();
if ($syllabusResult) {
    $syllabus = $syllabusResult->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error fetching syllabus records: " . $conn->error;
}


if (isset($_GET['delete_id'])) {
    $syllabusId = (int)$_GET['delete_id'];
    $deleteQuery = "DELETE FROM syllabus WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $syllabusId);
    if ($stmt->execute()) {
        echo "<script>alert('Syllabus deleted successfully.'); window.location.href = 'admin_syllabus.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
      
        $title = $_POST['title'];
        $link = $_POST['link'];

        $insertQuery = "INSERT INTO syllabus (title, link) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss", $title, $link);
        if ($stmt->execute()) {
            echo "<script>alert('Syllabus added successfully.'); window.location.href = 'admin_syllabus.php';</script>";
        } else {
            echo "Error adding syllabus: " . $conn->error;
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
    <title>Manage Syllabus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
   <?php require('admin_sidebar.php') ?>
    <div class="container">
        <h1 class="text-center mt-5">Manage Syllabus</h1>

        <div class="section">
            <h2>Syllabus</h2>

            <!-- Add Syllabus Form -->
            <form method="POST" action="admin_syllabus.php">
                <div class="form-group">
                    <label for="syllabus-title">Title</label>
                    <input type="text" class="form-control" id="syllabus-title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="syllabus-link">Link</label>
                    <input type="url" class="form-control" id="syllabus-link" name="link" required>
                </div>
                <button type="submit" name="add" class="btn btn-primary mt-2">Add Syllabus</button>
            </form>

            <!-- Syllabus Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($syllabus as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank"><?php echo htmlspecialchars($row['link']); ?></a></td>
                            <td>
                                <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this syllabus?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination for Syllabus -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item"><a class="page-link" href="?syllabusPage=<?php echo $currentPage - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php if ($currentPage < $totalPagesSyllabus): ?>
                        <li class="page-item"><a class="page-link" href="?syllabusPage=<?php echo $currentPage + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>