<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Sign up</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="icon" href="../resources/favicon.ico">
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container text-center tb-padding">
    <img src="../resources/logo.png">
    <h2>Sign up Page</h2>
    <p style="font-size: 15px">Please sign up</p>
    <form action="../scripts/process_signup.php" method="post">
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="form-control col-lg-3 col-centered" placeholder="Enter username" id="usr" name="usr">
      </div>
      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="form-control col-lg-3 col-centered" placeholder="Enter password" id="pwd" name="pwd">
      </div>
      <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
    <a href="../index.php" class="btn btn-link" role="button">Already have an account? Login</a>
  </div>
</body>
</html>
