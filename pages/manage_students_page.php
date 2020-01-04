<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Manage Students</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?version=2">
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
        <li class="active"><a href="manage_students_page.php">Manage Students</a></li>
        <li><a href="exam_data_page.php">Student Data</a></li>
        <li><a href="data_representation_page.php">Data Representation</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>
</body>
</html>
