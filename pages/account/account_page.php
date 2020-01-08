<?php
  session_start();
  $title = 'Account Page';
  $web_section = 'account';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(
    getenv('HTTP_HOST'),
    getenv('HTTP_USER'),
    getenv('HTTP_PASS'),
    getenv('HTTP_DATABASE')
  );
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $usr = $_SESSION['usr'];

  //aquire user's email and privlege for use in the page
  $stmt = $conn->prepare("SELECT Privilege FROM teacher WHERE Username=? LIMIT 1");
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($privilege);
  $stmt->fetch();
  $stmt->close();

  $stmt = $conn->prepare("SELECT Email FROM teacher WHERE Username=? LIMIT 1");
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($email);
  $stmt->fetch();
  $stmt->close();

  $conn->close();

  require($current_path . '/templates/navbar.php');
?>
  <div class="container text-center">
    <!-- Post results to self -->
    <form action="account_page.php" method="post">
      <!-- Username input field -->
      <div class="row form-group">
        <label for="usr" class="label-text text-center">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m" id="login-field"
        name="usr" value="<?php echo $usr; ?>" readonly>
        <!-- username is a unique identifier and cannot be changed -->
        <label for="usr">(Cannot be changed)</label>
      </div>

      <div class="row form-group">
        <label for="pwd" class="label-text text-center">New Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new password (leave blank to not change)" id="login-field"
        name="pwd" autocomplete="new-password">
      </div>

      <div class="row form-group">
        <label for="email" class="label-text text-center">New Email</label>
        <input type="email" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new email (leave blank to not change)" id="login-field"
        name="email" autocomplete="false" value="<?php echo $email; ?>">
      </div>

      <div class="row row-padded">
        <!-- TODO: create update account details script -->
        <button class="btn btn-success" type="submit">Save Changes</button>
        <!-- TODO: create delete account script -->
        <button class="btn btn-danger" type="button" onclick="deleteAccount()">Delete Account</button>
      </div>
    </form>

    <?php
      //Check user's privilege to determine if they are an admin and make admin settings available
      if($privilege <= 0){echo '<a class="btn btn-link tb-padding" role="button" href="admin_settings_page.php">Admin Settings</a>';}
    ?>
  </div>

  <div id="buffer-box"></div>
</body>
</html>
