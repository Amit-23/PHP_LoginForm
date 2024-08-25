<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$showAlert = false;

if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amitbasith@gmail.com';
        $mail->Password = 'pysadvrxygoxnrjn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('amitbasith@gmail.com', 'Amit Singh');
        $mail->addAddress($email, 'New User');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Login Credentials';
        $mail->Body = "<h3>Congrats, your account has been successfully created.</h3>
                       <h4>Username: $email</h4>
                       <h4>Password: $password</h4>";

        if ($mail->send()) {
            $showAlert = true; // Set the flag to true on successful email sending
        }

        // Clear session data after sending the email
        session_unset();
        session_destroy();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request. Session variables not set.";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php
if ($showAlert) {
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success!</strong> Your account has been successfully created. You can log in now.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';

    echo '<script>
            setTimeout(function() {
                window.location.href = "login.php";
            }, 2000);
          </script>';
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
