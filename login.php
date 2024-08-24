<?php
include 'partials/databaseconnect.php';
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    


    
    $sql1 = "SELECT * FROM `users` WHERE email='$email' AND password='$password';";
    $result1 = mysqli_query($conn,$sql1);
    // $result1 will contain pointer if success else will be FALSE if mysqli_query() fails;
    if($result1){
        
        if(mysqli_num_rows($result1) == 1){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("location: welcome.php");
            // header() is used to redirect to a url;

           

        } else{
            $showError = true;
            }

    }    
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
  <?php require 'partials/_nav.php' ?>


<?php



if($login){
    echo  '<div class="alert alert-success              alert-dismissible fade show" role="alert">
    <strong>SUCCESS!</strong> You are successfully logged in.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if($showError){
    echo  '<div class="alert alert-danger              alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Invalid Credentials.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}


?>

  <div class="container d-flex flex-column align-items-center my-3">
    <h1 class="text-center mb-5 text-primary">Login</h1>

    <form method="post" action="/loginsystem/login.php" class="w-50 p-4 bg-light shadow-lg rounded">
       
        <div class="mb-3 w-100">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 w-100">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div> 

       
        
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
    
