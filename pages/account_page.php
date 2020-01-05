<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Account</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.css?version=11">
  <link rel="icon" href="../resources/favicon.ico">
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand navtext" href="homepage.php"><img src="../resources/logo2.png"></a>
      </div>

      <ul class="nav navbar-nav">
        <!-- Account page is set to active -->
        <li class="active"><a href="account_page.php">Account</a></li>
        <li><a href="manage_students_page.php">Manage Students</a></li>
        <li><a href="exam_data_page.php">Exam Data</a></li>
        <li><a href="data_representation_page.php">Data Representation</a></li>
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
        <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <div class="container text-center tb-padding">
    <div id="title-text">
      Account Settings
    </div>
    <form action="../php/process_account_settings.php" method="post">
      <!-- Username input field -->
      <div id="label-text" class="text-center">
        Username
      </div>
      <div class="form-group">
        <label for="usr" class="sr-only">Username</label>
        <input type="username" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new username" id="login-field"
        name="usr" value="<?php echo $_SESSION['usr'] ?>">
      </div>

      <div id="label-text">
        New Password
      </div>
      <div class="form-group">
        <label for="pwd" class="sr-only">New Password</label>
        <input type="password" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new password" id="login-field"
        name="pwd">
      </div>

      <div id="label-text" class="text-center">
        Email
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" class="col-lg-4 col-centered form-control form-m" placeholder="Enter new email" id="login-field"
        name="email" value="<?php //TODO: retrieve email ?>">
      </div>

      <div class="form-group tb-padding">
        <button class="btn btn-success" type="submit">Save Changes</button>
        <button class="btn btn-danger" type="button" onclick="deleteAccount()">Delete Account</button>
      </div>
    </form>
    <!-- TODO: check privelege -->
    <a class="btn btn-link" role="button" href="admin_settings_page.php">Admin Settings</a>
  </div>

</body>
<!-- TODO: create actual account deletion function -->
<script>
function deleteAccount(){
  confirm("Are you sure?");
}
</script>
</html>
