<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Login</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="icon" href="resources/favicon.ico">
</head>
<body>
  <div class="container text-center tb-padding">
    <img src="resources/logo.png">
    <h2>User Login</h2>
    <p style="font-size: 15px">Please enter your login details</p>
    <form action="scripts/process_login.php" method="post">
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="form-control col-lg-3 col-centered" placeholder="Enter username" id="usr"
        name="usr" value="<?php if(isset($_SESSION['usr'])){echo $_SESSION['usr'];}?>">
      </div>
      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="form-control col-lg-3 col-centered" placeholder="Enter password" id="pwd"
        name="pwd" value="<?php if(isset($_SESSION['pwd'])){echo $_SESSION['pwd'];}?>">
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="remember"> Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <a href="pages/sign_up.php" class="btn btn-link" role="button">Don't have an account? Sign up</a>
  </div>
<body>
</html>
