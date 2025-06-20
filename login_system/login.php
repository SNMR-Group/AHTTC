<?php
session_start();
include "../db/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ? AND phone = ?");
    $stmt->bind_param("ss", $student_id, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['student_id'] = $student_id;
        header("Location: ./ebook.php");
        exit();
    } else {
        echo "<script>alert('Invalid Student ID or Phone Number!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Student Login</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" name="student_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
