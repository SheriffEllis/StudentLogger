<?php
  require($current_path . '/templates/metadata.php');
  //If user not logged in, redirect to login page
  if(empty($_SESSION['usr'])){
    header("Location: /StudentLogger/index.php");
  }
?>

  <!--
  This navbar is copied into each page of the website with the
  currently open page set to "active"
  -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand navtext" href="/StudentLogger/pages/homepage.php">
          <img class="navbar-logo" src="/StudentLogger/resources/logo2.png">
        </a>
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
              <?php
                include($current_path . "/php/retrieve_notifications.php");
                $Notifications = retrieveNotifications($_SESSION['usr']);
                echo "(" . count($Notifications) . ")";
              ?>
            </button>
            <ul class="dropdown-menu">
              <?php
                foreach($Notifications as $ID=>$Notification){
                  echo "
                    <li>
                      <a><button class=\"btn btn-danger\" onclick=\"readNotification('$ID')\">X</button> $Notification</a>
                    </li>
                  ";
                }
              ?>
            </ul>
          </div>
        </li>
        <li><a href="/StudentLogger/php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <?php
  //Don't display page title if on homepage
  if($title != "Home"){
    echo '<div class="title-text text-center">' . $title . '</div>';
  }
  ?>
