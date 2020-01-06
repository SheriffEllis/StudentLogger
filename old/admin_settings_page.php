<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: Admin Settings</title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/StudentLogger/css/style.css?version=16">
  <link rel="icon" href="/StudentLogger/resources/favicon.ico">
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand navtext" href="/StudentLogger/pages/homepage.php"><img src="/StudentLogger/resources/logo2.png"></a>
      </div>

      <ul class="nav navbar-nav">
        <!-- Set active page to class="active" -->
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
      Admin Settings
    </div>

    <div id="label-text">
      Select User
    </div>
    <!-- TODO create script for retrieving search results -->
    <form action="" method="post">
      <input id="searchbar" placeholder="Search..." type="text"></input>
      <button id="searchbutton" type="submit"><span class="glyphicon glyphicon-search"></span></button>
    </form>

    <!-- TODO: Use javascript to allow multiple buttons to use same selection? -->
    <select id="searchbox" size=10 class="col-lg-4 col-centered">
      <!-- TODO: Enter search results into these options -->
      <option>User1</option>
      <option>User2</option>
      <option>User3</option>
    </select>
  </div>

  <!-- TODO: Hide with javascript if no user selected -->
  <div class="box container text-center tb-padding">
    <div id="label-text">
      [Selected User]
    </div>
  </div>

</body>
</html>
