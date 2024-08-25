<?php
session_start();
include 'partials/databaseconnect.php';
$emailExists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email already exists in the database
    $sql1 = "SELECT * FROM `users` WHERE email='$email';";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        if (mysqli_num_rows($result1) > 0) {
            $emailExists = true;
        } else {
            $username = substr($email, 0, strpos($email, '@')) . rand(1000, 9999);
            $password = bin2hex(random_bytes(4)); // Generate a random 8-character password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $sql = "INSERT INTO `users` (`username`, `email`, `password`, `dt`, `first_login`) VALUES ('$username', '$email', '$hashedPassword', current_timestamp(), TRUE);";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Store session data
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username; // This should be the username, not email
                $_SESSION['password'] = $password;

                // Redirect to sendMail.php
                 header("Location: sendMail.php");
                 
                exit();
                
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php require 'partials/_nav.php' ?>


    <?php

    if ($emailExists) {
        echo  '<div class="alert alert-danger              alert-dismissible fade show" role="alert">
    <strong>Error!</strong> User with the same email address already exists!.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <div class="container d-flex flex-column align-items-center my-3">
        <h1 class="text-center mb-5 text-primary">SignUp </h1>

        <form method="post" action="/loginsystem/signup.php" class="w-50 p-4 bg-light shadow-lg rounded">

            <div class="mb-3 w-100">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>




            <button type="submit" name="submitBtn" class="btn btn-primary w-100">SignUp</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>