<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit();
}

$email = $_SESSION['email'];
$username = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WELCOME - <?php echo $username; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <?php require 'partials/_nav.php'; ?>

  <div class="container-fluid bg-primary bg-gradient vh-100 d-flex align-items-center justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-header bg-dark text-white text-center">
          <h2>Welcome, <?php echo $username; ?>!</h2>
        </div>
        <div class="card-body">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">SUCCESS!</h4>
            <p>You have successfully logged in with the email: <strong><?php echo $email; ?></strong>.</p>
            <hr>
            <p class="mb-0">Click the button below to logout.</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="text-center mt-4">
            <a href="/loginsystem/logout.php" class="btn btn-danger btn-lg">Logout</a>
          </div>
        </div>
        <div class="card-footer text-muted text-center">
          Thank you for using our system!
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
