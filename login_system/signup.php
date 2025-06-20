<?php
session_start();
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../db/db.php';

// Enable detailed error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$error = '';
$success = '';

if (isset($_POST['signup'])) {
    // Get form data
    $student_id = trim($_POST['student_id']);
    $student_name = trim($_POST['student_name']);
    $password = trim($_POST['password']);
    $course_selection = trim($_POST['course_selection']);
    $course = trim($_POST['course']);
    $course_code = trim($_POST['course_code']);

    // Validation
    if (empty($student_id) || empty($student_name) || empty($password) || empty($course_selection) || empty($course) || empty($course_code)) {
        $error = "All fields are required!";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long!";
    } else {
        // Check if Student ID already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE student_id = ?");
        if (!$stmt) {
            die("SQL Error in SELECT: " . $conn->error);
        }
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Student ID already exists!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO users (student_id, student_name, password, course_selection, course, course_code) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("SQL Error in INSERT: " . $conn->error);
            }

            $stmt->bind_param("ssssss", $student_id, $student_name, $hashed_password, $course_selection, $course, $course_code);

            if ($stmt->execute()) {
                $success = "Registration successful! Please login.";
            } else {
                $error = "Something went wrong. Please try again!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        input, select {
            width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer;
            width: 100%; font-size: 16px; font-weight: bold;
        }
        button:hover { background: #218838; }
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Sign Up</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <input type="text" name="student_id" placeholder="Student ID" required>
        </div>
        <div class="form-group">
            <input type="text" name="student_name" placeholder="Student Name" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <select name="course_selection" required>
                <option value="" disabled selected>Select Course...</option>
                <option value="B.ed">B.ed</option>
                <option value="D.eled">D.eled</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="course" placeholder="Course" required>
        </div>
        <div class="form-group">
            <input type="text" name="course_code" placeholder="Course Code" required>
        </div>
        <button type="submit" name="signup">Sign Up</button>
    </form>

    <p style="margin-top: 15px; text-align:center;">
        Already have an account? <a href="login.php">Login</a>
    </p>
</body>
</html>
