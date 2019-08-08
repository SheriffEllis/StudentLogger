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
    <h2>Sign up Page</h2>
    <p style="font-size: 15px">Please sign up</p>
    <form action="../scripts/process_signup.php" method="post">
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" class="col-lg-4 col-centered" placeholder="Enter email address" id=login-field name="email">
      </div>
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered" placeholder="Enter username" id=login-field name="usr">
      </div>
      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="col-lg-4 col-centered" placeholder="Enter password" id=login-field name="pwd">
      </div>
      <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
    <a href="../index.php" class="btn btn-link" role="button">Already have an account? Login</a>
  </div>
</body>
</html>
