<!DOCTYPE html>
<html lang="en">
<head>
  <title>StudentLogger: <?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name= "viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/StudentLogger/css/style.css?version=33">
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
        <a class="navbar-brand navtext" href="/StudentLogger/pages/homepage.php"><img src="/StudentLogger/resources/logo2.png"></a>
      </div>

      <!-- Set active website section to class="active" -->
      <ul class="nav navbar-nav">
        <li class="<?php if($web_section == 'account'){echo 'active';} ?>">
          <a href="/StudentLogger/pages/account/account_page.php">Account</a>
        </li>
        <li class="<?php if($web_section == 'manage_students'){echo 'active';} ?>">
          <a href="/StudentLogger/pages/manage_students/manage_students_page.php">Manage Students</a>
        </li>
        <li class="<?php if($web_section == 'exam_data'){echo 'active';} ?>">
          <a href="/StudentLogger/pages/exam_data/exam_data_page.php">Exam Data</a>
        </li>
        <li class="<?php if($web_section == 'data_representation'){echo 'active';} ?>">
          <a href="/StudentLogger/pages/data_representation/data_representation_page.php">Data Representation</a>
        </li>
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

  <?php
  //Don't display page title if on homepage
  if($title != "Home"){
    echo '<div class="title-text text-center">' . $title . '</div>';
  }
  ?>
