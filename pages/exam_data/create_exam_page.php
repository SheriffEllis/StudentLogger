<?php
  session_start();
  $title = 'Create Exam';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
  require($current_path . '/templates/entering_exam_data.php');
?>

  <div id="buffer-box"></div>
</body>
</html>
