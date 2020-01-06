<?php
session_start();
$conn = new mysqli(
  getenv('HTTP_HOST'),
  getenv('HTTP_USER'),
  getenv('HTTP_PASS'),
  getenv('HTTP_DATABASE')
);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Account</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/StudentLogger/css/style.css?version=11">
  <link rel="icon" href="/StudentLogger/resources/favicon.ico">
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand navtext" href="/StudentLogger/pages/homepage.php"><img src="/StudentLogger/resources/logo2.png"></a>
      </div>

      <ul class="nav navbar-nav">
        <!-- Account page is set to active -->
        <li class="active"><a href="/StudentLogger/pages/account/account_page.php">Account</a></li>
        <li><a href="/StudentLogger/pages/manage_students/manage_students_page.php">Manage Students</a></li>
        <li><a href="/StudentLogger/pages/exam_data/exam_data_page.php">Exam Data</a></li>
        <li><a href="/StudentLogger/pages/data_representation/data_representation_page.php">Data Representation</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <!-- Construction of notification dropdown box -->
          <div id="notifications-dropdown" class="dropdown">
            <button id="notifications-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="glyphicon glyphicon-bell"></span>
              <!-- TODO: substitute real number of notifications -->
              (3)
            </button>
            <ul class="dropdown-menu">
              <!-- TODO: substitute real notifications -->
              <li><a href="#">[STUDENT1] is struggling in [CLASS1]</a></li>
              <li><a href="#">[STUDENT2] is struggling in [CLASS2]</a></li>
              <li><a href="#">[STUDENT3] is struggling in [CLASS3]</a></li>
            </ul>
          </div>
        </li>
        <li><a href="/StudentLogger/index.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <div class="container text-center tb-padding">
    <div id="title-text">
      Account Settings
    </div>
    <form action="/StudentLogger/php/process_account_settings.php" method="post">
      <!-- Username input field -->
      <div id="label-text" class="text-center">
        New Username
      </div>
      <div class="form-group">
        <input type="username" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new username (leave blank to not change)" id="login-field"
        name="usr" autocomplete="false" value="<?php echo $usr ?>">
        <!-- currently stored value of username should be input automatically instead of user's autocomplete -->
      </div>

      <div id="label-text">
        New Password
      </div>
      <div class="form-group">
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new password (leave blank to not change)" id="login-field"
        name="pwd" autocomplete="new-password">
      </div>

      <div id="label-text" class="text-center">
        New Email
      </div>
      <div class="form-group">
        <input type="email" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new email (leave blank to not change)" id="login-field"
        name="email" autocomplete="false" value="<?php echo $email ?>">
      </div>

      <div class="form-group tb-padding">
        <button class="btn btn-success" type="submit">Save Changes</button>
        <button class="btn btn-danger" type="button" onclick="deleteAccount()">Delete Account</button>
      </div>
    </form>
    <?php
    //Check user's privilege to determine if they are an admin and make admin settings available
    if($privilege <= 0){echo "<a class='btn btn-link' role='button' href='admin_settings_page.php'>Admin Settings</a>";}
    ?>
  </div>

</body>
<!-- TODO: create actual account deletion function -->
<script>
function deleteAccount(){
  confirm("Are you sure?");
}
</script>
</html>
