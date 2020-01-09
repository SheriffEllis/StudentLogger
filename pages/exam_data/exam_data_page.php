<?php
  session_start();
  $title = 'Exam Data Page';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');

  //Exam Query Box
  $is_container = true;
  $label = 'Select Exam';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('Exam1', 'Exam2', 'Exam3');
  //TODO: substitute actual code in the buttons
  $buttons = '
  <div class="text-center">
    <a class="btn-regular btn btn-success" href="create_exam_page.php">Add Exam</a>
    <a class="btn-regular btn btn-warning" href="edit_exam_page.php">Edit Exam</a>
    <a class="btn-regular btn btn-danger" href="#">Remove Exam</a>
    <a class="btn-regular btn btn-primary" href="view_exam_page.php">View Exam</a>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>
</body>
</html>
