<?php
  session_start();
  $title = 'Home';
  $web_section = '';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . "/templates/navbar.php");
?>

<div class="container text-size-m tb-padding">
  <div class="title-text text-center">
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

<div id="buffer-box"></div>
</body>
</html>
