<?php
// Load Composer's autoloader
require'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $course = htmlspecialchars($_POST['course']);
    $semester = htmlspecialchars($_POST['semester']);
    $student_id = htmlspecialchars($_POST['student_id']);
    $specialization = htmlspecialchars($_POST['specialization']);
    $query_type = htmlspecialchars($_POST['query_type']);
    $priority = htmlspecialchars($_POST['priority']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $preferred_contact = htmlspecialchars($_POST['preferred_contact']);
    $response_time = htmlspecialchars($_POST['response_time']);

    // Compose email body
    $email_body = "
        <h2>New Education Query Submitted</h2>
        <p><strong>Name:</strong> $first_name $last_name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Course Program:</strong> $course</p>
        <p><strong>Semester/Year:</strong> $semester</p>
        <p><strong>Student ID:</strong> $student_id</p>
        <p><strong>Specialization:</strong> $specialization</p>
        <p><strong>Query Type:</strong> $query_type</p>
        <p><strong>Priority:</strong> $priority</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Query Message:</strong><br>$message</p>
        <p><strong>Preferred Contact:</strong> $preferred_contact</p>
        <p><strong>Expected Response Time:</strong> $response_time</p>
    ";

    // PHPMailer setup
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kartavyaplacement111@gmail.com'; // Your email
        $mail->Password   = 'cyygpddjzjrhtgnz'; // Use App Password if using Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom('kartavyaplacement111@gmail.com', 'Education Query Form');
        $mail->addAddress('singhpriyankasbg00@gmail.com'); // Replace with your receiving email

        // Content
        $mail->isHTML(true);
        $mail->Subject = "📩 New Education Query: $subject";
        $mail->Body    = $email_body;

        $mail->send();
        echo "Query submitted successfully. We will contact you soon.";
    } catch (Exception $e) {
        echo "Query could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
