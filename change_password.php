<?php
session_start();
include 'partials/databaseconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['first_login'] != true) {
    header("location: login.php");
    exit();
}

$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE `users` SET `password`='$hashedPassword', `first_login`=FALSE WHERE `email`='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
            $_SESSION['first_login'] = false;
            header("location: welcome.php");
            exit();
        } else {
            $showError = "Error updating password.";
        }
    } else {
        $showError = "Passwords do not match.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php require 'partials/_nav.php' ?>

    <div class="container d-flex flex-column align-items-center my-3">
        <h1 class="text-center mb-5 text-primary">Change Password</h1>

        <?php
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your password has been updated.
                  </div>';
        }
        if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $showError . '
                  </div>';
        }
        ?>

        <form method="post" action="change_password.php" class="w-50 p-4 bg-light shadow-lg rounded">
            <div class="mb-3 w-100">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password" required>
            </div>
            <div class="mb-3 w-100">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Change Password</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
