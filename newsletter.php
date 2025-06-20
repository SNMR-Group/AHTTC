<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

 
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

            $mail->setFrom('snupur604@gmail.com', 'RGMTTC ADMIN');
            $mail->addAddress('mahatosanjay207@gmail.com');  

            $mail->Subject = 'New Subscription Request';
            $mail->Body    = "A new user has subscribed with the following email: $email";

            if ($mail->send()) {
              
                echo '
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Subscription Success</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                        }
                        .alert-heading {
                            font-size: 1.5rem;
                            color: #2e7d32;
                        }
                        .alert {
                            background-color: #d4edda;
                            border-color: #c3e6cb;
                            color: #155724;
                        }
                        #countdown {
                            font-weight: bold;
                            font-size: 1.5rem;
                        }
                    </style>
                </head>
                <body>
                    <div class="container mt-5">
                        <div class="alert alert-success text-center" role="alert">
                            <h4 class="alert-heading"><i class="bi bi-check-circle"></i> Thank You for Subscribing!</h4>
                            <p>You will be redirected back in <strong><span id="countdown">5</span></strong> seconds.</p>
                            <hr>
                            <p class="mb-0">We appreciate your subscription to our newsletter!</p>
                        </div>
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
                echo '<div class="alert alert-danger">Failed to send the subscription email. Please try again.</div>';
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo '<div class="alert alert-warning">Invalid email address. Please enter a valid email.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request.</div>';
}
?>
