<?php
  session_start();
  unset($_SESSION['usr']);
  $title = 'Login';
  $current_path = getenv('CURRENT_PATH');
  include($current_path . '/php/process_login.php');
  require($current_path . '/templates/metadata.php');
?>

  <div class="container text-center tb-padding">
    <img src="/StudentLogger/resources/logo.png">
    <h2>User Login</h2>
    <p style="font-size: 15px">Please enter your login details</p>
    <!-- The form data is sent to a separate php script file which judges the validity of the login data -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m" placeholder="Enter username"
        name="usr" required autocomplete="<?php
          //Auto input username if user clicked "Remember me" tickbox
          if(empty($_SESSION['remember'])){
            echo "false";
          }else{
            echo "username";
          }
        ?>">
      </div>
      <div class="col-centered error-box <?php if(empty($wrng_usr)){echo 'hidden';} ?>">
        Username does not exist
      </div>
      <!-- Show errorbox when login algorithm returns that username does not exist -->

      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter password" 
        name="pwd" required autocomplete="<?php
          //Auto input password if user clicked "Remember me" tickbox
          if(empty($_SESSION['remember'])){
            echo "false";
          }else{
            echo "password";
          }
        ?>">
      </div>
      <div class="col-centered error-box <?php if(empty($wrng_pwd)){echo 'hidden';} ?>">
        Incorrect password, please try again
      </div>
      <!-- Show errorbox when login algorithm returns that password is invalid -->

      <div class="checkbox">
        <!-- Retain if "Remember me" tickbox was checked -->
        <label><input type="checkbox" name="remember" <?php if(!empty($_SESSION['remember'])){echo "checked";} ?>> Remember me</label>
      </div>
      <button type="submit" name="submitted" value="true" class="btn btn-primary">Log in</button>
    </form>
    <a href="/StudentLogger/pages/sign_up_page.php" class="btn btn-link" role="button">Don't have an account? Sign up</a>
  </div>

  <div id="buffer-box"></div><!-- Creates vertical space between elements -->
<body>
</html>
