<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Home</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/StudentLogger/css/style.css?version=11">
  <link rel="icon" href="/StudentLogger/resources/favicon.ico">
</head>
<body>

  <!--
  This navbar is copied into each page of the website with the
  currently open page set to "active"
  -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <!-- Student Logger logo links back to homepage -->
        <a class="navbar-brand navtext" href="/StudentLogger/pages/homepage.php"><img src="/StudentLogger/resources/logo2.png"></a>
      </div>

      <ul class="nav navbar-nav">
        <!-- On the homepage none of the pages are set to active -->
        <li><a href="/StudentLogger/pages/account/account_page.php">Account</a></li>
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

  <div class="container text-size-m tb-padding">
    <div id="title-text" class="text-center">
      Welcome back, <?php echo $_SESSION['usr'];?>
    </div>

    <div class="row row-padded">
      <div class="col-lg-6 text-center">
        <a class="btn btn-primary btn-mega" href="/StudentLogger/pages/account/account_page.php">
          <p><img src="/StudentLogger/resources/account.png"><br>Account</p>
        </a>
      </div>
      <div class="col-lg-6 text-center">
        <a class="btn btn-success btn-mega" href="/StudentLogger/pages/manage_students/manage_students_page.php">
          <p><img src="/StudentLogger/resources/manage_students.png"><br>Manage Students</p>
        </a>
      </div>
    </div>
    <div class="row row-padded">
      <div class="col-lg-6 text-center">
        <a class="btn btn-danger btn-mega" href="/StudentLogger/pages/exam_data/exam_data_page.php">
          <p><img src="/StudentLogger/resources/student_data.png"><br>Exam Data</p>
        </a>
      </div>
      <div class="col-lg-6 text-center">
        <a class="btn btn-warning btn-mega" href="/StudentLogger/pages/data_representation/data_representation_page.php">
          <p><img src="/StudentLogger/resources/data_representation.png"><br>Data Representation</p>
        </a>
      </div>
    </div>
  </div>

</body>
</html>
