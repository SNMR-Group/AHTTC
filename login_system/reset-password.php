<?php
session_start();
include '../db/db.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Error & success messages
$error = '';
$success = '';

// Step 1: Request OTP
if (isset($_POST['request_otp'])) {
    $email = trim($_POST['email']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $error = "Email not found!";
        } else {
            // Generate OTP & expiry time
            $otp = rand(100000, 999999);
            $otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

            // Store OTP in database
            $stmt = $conn->prepare("UPDATE users SET otp=?, otp_expiry=? WHERE email=?");
            $stmt->bind_param("sss", $otp, $otp_expiry, $email);
            $stmt->execute();

            // Send OTP via PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'snmrcloudservices@gmail.com'; // Replace with your email
                $mail->Password   = 'emvkwtkynubkobpy'; // Replace with your App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                // Email settings
                $mail->setFrom('snmrcloudservices@gmail.com', 'AHTTC');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset OTP';
                $mail->Body    = "Your OTP for password reset is: <b>$otp</b><br>Valid for 10 minutes.";

                $mail->send();
                $success = "OTP sent to your email!";
                $_SESSION['reset_email'] = $email; // Store email in session for next step
            } catch (Exception $e) {
                $error = "Failed to send OTP. Error: " . $mail->ErrorInfo;
            }
        }
    }
}

// Step 2: Verify OTP & Reset Password
if (isset($_POST['reset_password'])) {
    $email = $_SESSION['reset_email'] ?? '';
    $otp = trim($_POST['otp']);
    $new_password = trim($_POST['new_password']);

    if (empty($email) || empty($otp) || empty($new_password)) {
        $error = "All fields are required!";
    } else {
        // Verify OTP
        $stmt = $conn->prepare("SELECT otp, otp_expiry FROM users WHERE email=?");
        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['otp'] === $otp && strtotime($row['otp_expiry']) > time()) {
            // Hash new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password & clear OTP
            $stmt = $conn->prepare("UPDATE users SET password=?, otp=NULL, otp_expiry=NULL WHERE email=?");
            $stmt->bind_param("ss", $hashed_password, $email);
            $stmt->execute();

            $success = "Password updated successfully!";
            $show_countdown = true;
            unset($_SESSION['reset_email']); // Clear session after success
        } else {
            $error = "Invalid or expired OTP!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Reset Password</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php if (isset($show_countdown) && $show_countdown): ?>
            <div>Redirecting to login page in <span id="countdown">5</span> seconds...</div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let countdownElement = document.getElementById("countdown");
                    if (!countdownElement) return;

                    let seconds = 5;
                    let interval = setInterval(function () {
                        countdownElement.innerText = seconds;
                        seconds--;
                        if (seconds < 0) {
                            clearInterval(interval);
                            window.location.href = "login.php"; // Redirect to login page
                        }
                    }, 1000);
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Step 1: Request OTP -->
    <form method="POST">
        <h3>Step 1: Enter Email</h3>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="request_otp">Send OTP</button>
    </form>

    <!-- Step 2: Verify OTP & Reset Password -->
    <?php if (isset($_SESSION['reset_email'])): ?>
        <form method="POST">
            <h3>Step 2: Reset Password</h3>
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="reset_password">Reset Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
