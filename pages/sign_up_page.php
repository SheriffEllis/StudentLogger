<?php
  session_start();
  $title = 'Sign Up';
  $current_path = getenv('CURRENT_PATH');
  include($current_path . '/php/process_signup.php');
  require($current_path . '/templates/metadata.php');
?>

  <div class="container text-center tb-padding">
    <img src="/StudentLogger/resources/logo.png">
    <h2>Sign up</h2>
    <p style="font-size: 15px">Please enter your details to create an account</p>
    <!-- The form data is sent to a separate php script file which judges the validity of the signup data -->
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" class="col-lg-4 col-centered form-control form-m" placeholder="Enter email address"
        name="email" required autocomplete="email" value="<?php if(!empty($email)){echo $email;} ?>">
        <!-- email is filled in if it was entered before -->
      </div>
      <div class="col-centered error-box <?php if(empty($invld_email)){echo 'hidden';} ?>">
        <b>Email invalid:</b> must be less than 320 characters and a real email address.
      </div>
      <!-- Show errorbox when signup algorithm returns that email is invalid -->

      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m" placeholder="Enter username"
        name="usr" required autocomplete="username" value="<?php if(!empty($usr)){echo $usr;} ?>">
        <!-- username is filled in if it was entered before -->
      </div>
      <div class="col-centered error-box <?php if(empty($invld_usr)){echo 'hidden';} ?>">
        <b>Username invalid:</b> must be less than 50 characters and contain no special characters.
      </div>
      <div class="col-centered error-box <?php if(empty($usr_unavailable)){echo 'hidden';} ?>">
        <b>Username invalid:</b> this username has already been taken.
      </div>
      <!-- Show errorbox when signup algorithm returns that username is invalid -->

      <div class="form-group">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter password" 
        name="pwd" required autocomplete="new-password" value="<?php if(!empty($pwd)){echo $pwd;} ?>">
        <!-- password is filled in if it was entered before -->
      </div>
      <div class="col-centered error-box <?php if(empty($invld_pwd)){echo 'hidden';} ?>">
        <b>Password invalid:</b> must contain at least one number, one lower and upper case letter, and no white spaces.
      </div>
      <!-- Show errorbox when signup algorithm returns that password is invalid -->

      <button type="submit" name="submitted" value="true" class="btn btn-primary">Sign up</button>
    </form>
    <a href="/StudentLogger/index.php" class="btn btn-link" role="button">Already have an account? Login</a>
  </div>

  <div id="buffer-box"></div>
</body>
</html>
