<?php
include 'partials/databaseconnect.php';
$showAlert = false;
$passwordMismatch = false;
$userExists = false;
$emailExists = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];



    // checking if the email already exists in the database
    $sql1 = "SELECT * FROM `users` WHERE email='$email';";
    $result1 = mysqli_query($conn,$sql1);
    // $result1 will contain pointer if success else will be FALSE if mysqli_query() fails;
    if($result1){
        
        if(mysqli_num_rows($result1)>0){
            $emailExists = true;
           

        } else{
            $emailExists = false;
            }

    }

// checking if the username already exists in the database
    $sql2 = "SELECT * FROM `users` WHERE username='$username';";
    $result2 = mysqli_query($conn,$sql2);
    // $result2 will contain pointer if success else will be FALSE if mysqli_query() fails;
    if($result2){
        
        if(mysqli_num_rows($result2)>0){
            $userExists = true;
           

        } else{
            $userExists = false;
            }

    }


    // here if the username and email already does not exists then the data must be inserted to the database
    if(($password == $cpassword) && $userExists == false && $emailExists == false){

        $sql = "INSERT INTO `users` (`username`, `email`, `password`, `dt`) VALUES ('$username', '$email', '$password', current_timestamp());";

        $result = mysqli_query($conn,$sql);

        if($result){
            $showAlert = true;
        }
    }

    if($password != $cpassword){
        $passwordMismatch = true;

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

if($showAlert){
    echo  '<div class="alert alert-success              alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account   successfully created you can login now.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if($passwordMismatch){
    echo  '<div class="alert alert-danger              alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Passwords must be same.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if($emailExists){
    echo  '<div class="alert alert-danger              alert-dismissible fade show" role="alert">
    <strong>Error!</strong> User with the same email address already exists!.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if($userExists){
    echo  '<div class="alert alert-danger              alert-dismissible fade show" role="alert">
    <strong>Error!</strong> User with the same User name already exists!. Please try some other Username.
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

?>

  <div class="container d-flex flex-column align-items-center my-3">
    <h1 class="text-center mb-5 text-primary">SignUp </h1>

    <form method="post" action="/loginsystem/signup.php" class="w-50 p-4 bg-light shadow-lg rounded">
        <div class="mb-3 w-100">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 w-100">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 w-100">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div> 

        <div class="mb-3 w-100">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
        </div>
        
        <button type="submit" class="btn btn-primary w-100">SignUp</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
    
