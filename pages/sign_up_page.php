<?php
session_start();
//Reset login errorboxes
unset($_SESSION['wrng_pwd']);
unset($_SESSION['wrng_usr']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Sign up</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/StudentLogger/css/style.css?version=11">
  <link rel="icon" href="/StudentLogger/resources/favicon.ico">
</head>
<body>

  <div class="container text-center tb-padding">
    <img src="/StudentLogger/resources/logo.png">
    <h2>Sign up</h2>
    <p style="font-size: 15px">Please enter your details to create an account</p>
    <!-- The form data is sent to a separate php script file which judges the validity of the signup data -->
    <form action="/StudentLogger/php/process_signup.php" method="post">
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" class="col-lg-4 col-centered form-control form-m" placeholder="Enter email address" id=login-field
        name="email" required autocomplete="email" value="<?php if(!empty($_SESSION['email'])){echo $_SESSION['email'];} ?>">
        <!-- email is filled in if it was entered before -->
      </div>
      <div class="col-centered error-box <?php if(empty($_SESSION['invld_email'])){echo 'hidden';} ?>">
        <b>Email invalid:</b> must be less than 320 characters and a real email address.
      </div>
      <!-- Show errorbox when signup algorithm returns that email is invalid -->

      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m" placeholder="Enter username" id=login-field
        name="usr" required autocomplete="username" value="<?php if(!empty($_SESSION['usr'])){echo $_SESSION['usr'];} ?>">
        <!-- username is filled in if it was entered before -->
      </div>
      <div class="col-centered error-box <?php if(empty($_SESSION['invld_usr'])){echo 'hidden';} ?>">
        <b>Username invalid:</b> must be less than 50 characters and contain no special characters.
      </div>
      <div class="col-centered error-box <?php if(empty($_SESSION['usr_unavailable'])){echo 'hidden';} ?>">
        <b>Username invalid:</b> this username has already been taken.
      </div>
      <!-- Show errorbox when signup algorithm returns that username is invalid -->

      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter password" id=login-field
        name="pwd" required autocomplete="new-password" value="<?php if(!empty($_SESSION['pwd'])){echo $_SESSION['pwd'];} ?>">
        <!-- password is filled in if it was entered before -->
      </div>
      <div class="col-centered error-box <?php if(empty($_SESSION['invld_pwd'])){echo 'hidden';} ?>">
        <b>Password invalid:</b> must contain at least one number, one lower and upper case letter, and no white spaces.
      </div>
      <!-- Show errorbox when signup algorithm returns that password is invalid -->

      <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
    <a href="/StudentLogger/index.php" class="btn btn-link" role="button">Already have an account? Login</a>
  </div>

  <div id="buffer-box"></div>
</body>
</html>
