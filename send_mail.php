<?php
// Import PHPMailer classes using Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader (adjust the path if needed)
require 'vendor/autoload.php';  // Make sure PHPMailer's autoloader is correctly included

// Initialize variables for message display
$alertMessage = '';
$alertType = '';
$formSubmitted = false;  // To track if the form has been successfully submitted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Validate form inputs
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        $alertMessage = 'Please fill in all the fields.';
        $alertType = 'danger';  // Bootstrap "danger" class for errors
    } else {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'kartavyaplacement111@gmail.com';  // Your email address
            $mail->Password = 'cyygpddjzjrhtgnz';  // Your email password or App password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('kartavyaplacement111@gmail.com', 'Kartavya Placements');
            $mail->addAddress('kumaripriyankasbg30@gmail.com', 'Recipient Name');  // The recipient's email address
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $phone;
            $mail->Body = "<p><strong>Name:</strong> $name</p>
                           <p><strong>Email:</strong> $email</p>
                           <p><strong>Message:</strong><br>$message</p>";

            // Send the email
            $mail->send();
            $alertMessage = 'Message sent successfully!';
            $alertType = 'success';  // Bootstrap "success" class for success
            $formSubmitted = true;  // Set the flag to true when the form is successfully submitted
        } catch (Exception $e) {
            // Show error message for debugging
            $alertMessage = "Message could not be sent. Error: " . $mail->ErrorInfo;
            $alertType = 'danger';
        }
    }
}
?>

<!-- Alert message for form submission result -->
<?php if ($alertMessage): ?>
    <div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert">
        <?= $alertMessage ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Redirection Alert -->
<div class="alert alert-info alert-dismissible fade show" role="alert">
    You will be redirected in <span id="counter">5</span> seconds.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<script>
    // Countdown timer
    var counter = 5;
    var interval = setInterval(function () {
        counter--;
        if (counter >= 0) {
            document.getElementById('counter').innerText = counter;
        }
        if (counter === 0) {
            clearInterval(interval);
            // Redirect to the desired page
            window.location.href = 'index.php'; // Change 'index.php' to your desired URL
        }
    }, 1000);
</script>
