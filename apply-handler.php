<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
           
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'snupur604@gmail.com';  
            $mail->Password = 'tqayxbwymtdsasgc'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

           
            $mail->setFrom('snupur604@gmail.com', 'RGMTTC Website');
            $mail->addAddress('mahatosanjay207@gmail.com');  
          
            $mail->Subject = $subject;
            $mail->Body = "You have received a new message from your website contact form.\n\n"
                . "Here are the details:\n"
                . "Name: $name\n"
                . "Email: $email\n"
                . "Subject: $subject\n"
                . "Message:\n$message";

            
            if ($mail->send()) {
              
                echo '
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Message Sent</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body {
                            background-color: #f4f4f4;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                        }
                        .message-box {
                            text-align: center;
                            padding: 20px;
                            background: #e8f5e9;
                            border: 1px solid #c8e6c9;
                            color: #2e7d32;
                            border-radius: 8px;
                        }
                    </style>
                </head>
                <body>
                    <div class="message-box">
                        <h4>Message Sent Successfully!</h4>
                        <p>Thank you for contacting us, ' . $name . '. We will get back to you soon!</p>
                        <p>You will be redirected in <strong><span id="countdown">5</span></strong> seconds.</p>
                    </div>
                    <script>
                        let countdown = 5;
                        const countdownElement = document.getElementById("countdown");
                        const countdownInterval = setInterval(() => {
                            countdown--;
                            countdownElement.textContent = countdown;
                            if (countdown <= 0) {
                                clearInterval(countdownInterval);
                                history.back(); // Redirects to the previous page
                            }
                        }, 1000);
                    </script>
                </body>
                </html>';
            } else {
                echo '<div class="alert alert-danger">Message could not be sent. Please try again later.</div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Message could not be sent. Error: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Invalid email address. Please enter a valid email.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request.</div>';
}
?>
