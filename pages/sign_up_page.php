<?php
session_start();
//Reset login errorboxes
$_SESSION['wrng_pwd'] = false;
$_SESSION['wrng_usr'] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Sign up</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?version=1">
  <link rel="icon" href="../resources/favicon.ico">
</head>
<body>
  <div class="container text-center tb-padding">
    <img src="../resources/logo.png">
    <h2>Sign up</h2>
    <p style="font-size: 15px">Please enter your details to create an account</p>
    <form action="../php/process_signup.php" method="post">
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" class="col-lg-4 col-centered" placeholder="Enter email address" id=login-field name="email">
      </div>
        <?php
        //Show errorbox when signup algorithm returns that email is invalid
        if(!empty($_SESSION['invld_email'])){echo "<div class='col-centered error-box'> Email invalid: must be less than 320 characters and a real email address. </div>";}
        ?>
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered" placeholder="Enter username" id=login-field name="usr">
      </div>
        <?php
        //Show errorbox when signup algorithm returns that username is invalid
        if(!empty($_SESSION['invld_usr'])){echo "<div class='col-centered error-box'> Username invalid: must be less than 50 characters and contain no special characters. </div>";}
        if(!empty($_SESSION['usr_unavailable'])){echo "<div class='col-centered error-box'> This username has already been used. </div>";}
        ?>
      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="col-lg-4 col-centered" placeholder="Enter password" id=login-field name="pwd">
      </div>
        <?php
        //Show errorbox when signup algorithm returns that password is invalid
        if(!empty($_SESSION['invld_pwd'])){echo "<div class='col-centered error-box'> Password invalid: must contain at least one number, one lower and upper case letter, and no white spaces. </div>";}
        ?>
      <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
    <a href="../index.php" class="btn btn-link" role="button">Already have an account? Login</a>
  </div>
</body>
</html>
