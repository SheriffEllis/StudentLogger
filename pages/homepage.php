<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Home</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?version=3">
  <link rel="icon" href="../resources/favicon.ico">
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand navtext" href="homepage.php"><img src="../resources/logo2.png"></a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="account_page.php">Account</a></li>
        <li><a href="manage_students_page.php">Manage Students</a></li>
        <li><a href="exam_data_page.php">Student Data</a></li>
        <li><a href="data_representation_page.php">Data Representation</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>
  <div class="container text-size-m" style="padding-bottom: 80px">
    <div id="welcome" class="text-center">
      Welcome back, <?php echo $_SESSION['usr'];?>
    </div>
    <div class="row row-padded">
      <div class="col-lg-6 text-center">
        <a class="btn btn-primary btn-mega" href="account.php">
          <p><img src="../resources/account.png"><br>Account</p>
        </a>
      </div>
      <div class="col-lg-6 text-center">
        <a class="btn btn-success btn-mega" href="manage_students.php">
          <p><img src="../resources/manage_students.png"><br>Manage Students</p>
        </a>
      </div>
    </div>
    <div class="row row-padded">
      <div class="col-lg-6 text-center">
        <a class="btn btn-danger btn-mega" href="student_data.php">
          <p><img src="../resources/student_data.png"><br>Student Data</p>
        </a>
      </div>
      <div class="col-lg-6 text-center">
        <a class="btn btn-warning btn-mega" href="data_representation.php">
          <p><img src="../resources/data_representation.png"><br>Data Representation</p>
        </a>
      </div>
    </div>
  </div>
</body>
</html>
