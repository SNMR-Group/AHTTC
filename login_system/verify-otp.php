<?php
session_start();
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '../db/db.php';

// Redirect if email is not in session
if (!isset($_SESSION['verify_email'])) {
    header("Location: signup.php");
    exit;
}

$email = $_SESSION['verify_email'];
$error = '';
$success = '';

// Verify OTP
if (isset($_POST['verify_otp'])) {
    $user_otp = trim($_POST['otp']);

    if (empty($user_otp)) {
        $error = "OTP is required!";
    } else {
        // Get current time in PHP
        $current_time = date("Y-m-d H:i:s");

        // Fetch stored OTP and expiry time from database
        $stmt = $conn->prepare("SELECT otp, otp_expiry FROM users WHERE email=?");

        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Debugging output
        if ($row) {
            echo "Stored OTP: " . htmlspecialchars($row['otp']) . "<br>";
            echo "Entered OTP: " . htmlspecialchars($user_otp) . "<br>";
            echo "OTP Expiry: " . htmlspecialchars($row['otp_expiry']) . "<br>";
            echo "Current Time: " . $current_time . "<br>";
        } else {
            die("No user found with this email!");
        }

        // Validate OTP and expiry
        if ($row && $row['otp'] === $user_otp && strtotime($row['otp_expiry']) > strtotime($current_time)) {
            // Update user verification status
            $stmt = $conn->prepare("UPDATE users SET verified=1, otp=NULL, otp_expiry=NULL WHERE email=?");

            if (!$stmt) {
                die("SQL Error: " . $conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();

            // Clear session and redirect to login
            unset($_SESSION['verify_email']);
            $_SESSION['success'] = "Email verified successfully! You can now log in.";
            header("Location: login.php");
            exit;
        } else {
            $error = "Invalid or expired OTP!";
        }
    }
}

// Resend OTP
if (isset($_POST['resend_otp'])) {
    $new_otp = random_int(100000, 999999);
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

    // Update OTP in database
    $stmt = $conn->prepare("UPDATE users SET otp=?, otp_expiry=? WHERE email=?");

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("sss", $new_otp, $otp_expiry, $email);
    $stmt->execute();

    // Send new OTP via email
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'snmrcloudservices@gmail.com'; // Replace with your email
        $mail->Password   = 'emvkwtkynubkobpy'; // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Email content
        $mail->setFrom('snmrcloudservices@gmail.com', 'Your App Name');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'New Email Verification OTP';
        $mail->Body    = "Your new verification OTP is: <b>$new_otp</b><br>Valid for 10 minutes";

        $mail->send();
        $success = "New OTP sent to your email!";
    } catch (Exception $e) {
        $error = "Failed to send OTP. Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        input[type="text"] { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Verify Email</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <input type="text" name="otp" placeholder="Enter OTP" required>
        </div>
        <button type="submit" name="verify_otp">Verify</button>
    </form>

    <form method="POST">
        <p>Didn't receive OTP? <button type="submit" name="resend_otp">Resend OTP</button></p>
    </form>
</body>
</html>
