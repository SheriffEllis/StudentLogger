<?php
  session_start();
  $title = 'Edit Exam';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  //TODO: re-enter data from selected exam
  require($current_path . '/templates/navbar.php');
  require($current_path . '/templates/entering_exam_data.php');
?>

  <div id="buffer-box"></div>
</body>
</html>
