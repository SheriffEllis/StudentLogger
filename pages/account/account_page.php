<?php
  session_start();
  $title = 'Account Page';
  $web_section = 'account';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $usr = $_SESSION['usr'];

  //aquire user's email and privlege for use in the page
  $stmt = $conn->prepare('SELECT Privilege, Email FROM teacher WHERE Username=? LIMIT 1');
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($privilege, $email);
  $stmt->fetch();
  $stmt->close();

  if(!empty($_POST['submitted'])){
    if(!empty($_POST['email'])){
      $email = $_POST['email'];

      //Email: must be <=320 characters, must be valid email
      $invld_email = strlen($email)>320 || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email);
      if(!$invld_email){
        $stmt = $conn->prepare('UPDATE teacher SET Email=? WHERE Username=?');
        $stmt->bind_param('ss', $email, $usr);
        $stmt->execute();
        $stmt->close();
      }
    }
    if(!empty($_POST['pwd'])){
      $pwd = $_POST['pwd'];

      //Password: at least one number, at least one lower-case and upper-case letter, no whitespaces
      $invld_pwd = !(preg_match("/\d+/", $pwd) &&
                    preg_match("/[a-z]+/", $pwd) &&
                    preg_match("/[A-Z]+/", $pwd) &&
                    !preg_match("/\s+/", $pwd));
      if(!$invld_pwd){
        $hash = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('UPDATE teacher SET Hash=? WHERE Username=?');
        $stmt->bind_param('ss', $hash, $usr);
        $stmt->execute();
        $stmt->close();
      }
    }

    $_POST['submitted'] = false;
  }

  $conn->close();

  require($current_path . '/templates/navbar.php');
?>
  <div class="container text-center">
    <!-- Post results to self -->
    <form action="account_page.php" method="post">
      <!-- Username input field -->
      <div class="row form-group">
        <label for="usr" class="label-text text-center">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m"
        name="usr" value="<?php echo $usr; ?>" readonly>
        <!-- username is a unique identifier and cannot be changed -->
        <label for="usr">(Cannot be changed)</label>
      </div>

      <div class="row form-group">
        <label for="pwd" class="label-text text-center">New Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new password (leave blank to not change)"
        name="pwd" autocomplete="new-password">
      </div>
      <div class="col-centered error-box <?php if(empty($invld_pwd)){echo 'hidden';} ?>">
        <b>Password invalid:</b> must contain at least one number, one lower and upper case letter, and no white spaces.
      </div>
      <!-- Show errorbox when signup algorithm returns that password is invalid -->

      <div class="row form-group">
        <label for="email" class="label-text text-center">New Email</label>
        <input type="email" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new email (leave blank to not change)"
        name="email" autocomplete="false" value="<?php echo $email; ?>">
      </div>
      <div class="col-centered error-box <?php if(empty($invld_email)){echo 'hidden';} ?>">
        <b>Email invalid:</b> must be less than 320 characters and a real email address.
      </div>
      <!-- Show errorbox when signup algorithm returns that email is invalid -->

      <div class="row row-padded">
        <button class="btn btn-success btn-regular" type="submit" name="submitted" value="true">Save Changes</button>
        <button class="btn btn-danger btn-regular" type="button" onclick="deleteAccount('<?php echo $_SESSION['usr'] ?>')">Delete Account</button>
      </div>
    </form>

    <?php
      //Check user's privilege to determine if they are an admin and make admin settings available
      if($privilege <= 0){echo '<a class="btn btn-link tb-padding" role="button" href="admin_settings_page.php">Admin Settings</a>';}
    ?>
  </div>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/deleteAccount.js"></script>
</html>
