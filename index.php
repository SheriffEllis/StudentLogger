<?php
session_start();
//Reset signup errorboxes
unset($_SESSION['invld_usr']);
unset($_SESSION['usr_unavailable']);
unset($_SESSION['invld_email']);
unset($_SESSION['invld_pwd']);
//Remove signup re-entries
unset($_SESSION['usr']);
unset($_SESSION['email']);
unset($_SESSION['pwd']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Login</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap and custom CSS stylesheet are both used in each page for aesthetic purposes -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/StudentLogger/css/style.css?version=11">
  <link rel="icon" href="/StudentLogger/resources/favicon.ico">
</head>
<body>

  <div class="container text-center tb-padding">
    <img src="/StudentLogger/resources/logo.png">
    <h2>User Login</h2>
    <p style="font-size: 15px">Please enter your login details</p>
    <!-- The form data is sent to a separate php script file which judges the validity of the login data -->
    <form action="/StudentLogger/php/process_login.php" method="post">
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m" placeholder="Enter username" id="login-field"
        name="usr" autocomplete="<?php
          //Auto input username if user clicked "Remember me" tickbox
          if(empty($_SESSION['remember'])){
            echo "false";
          }else{
            echo "username";
          }
        ?>">
      </div>
      <div class="col-centered error-box <?php if(empty($_SESSION['wrng_usr'])){echo 'hidden';} ?>">
        Username does not exist
      </div>
      <!-- Show errorbox when login algorithm returns that username does not exist -->

      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter password" id="login-field"
        name="pwd" autocomplete="<?php
          //Auto input password if user clicked "Remember me" tickbox
          if(empty($_SESSION['remember'])){
            echo "false";
          }else{
            echo "password";
          }
        ?>">
      </div>
      <div class="col-centered error-box <?php if(empty($_SESSION['wrng_pwd'])){echo 'hidden';} ?>">
        Incorrect password, please try again
      </div>
      <!-- Show errorbox when login algorithm returns that password is invalid -->

      <div class="checkbox">
        <!-- Retain if "Remember me" tickbox was checked -->
        <label><input type="checkbox" name="remember" <?php if(!empty($_SESSION['remember'])){echo "checked";} ?>> Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <a href="/StudentLogger/pages/sign_up_page.php" class="btn btn-link" role="button">Don't have an account? Sign up</a>
  </div>

  <div id="buffer-box"></div><!-- Creates vertical space between elements -->
<body>
</html>
