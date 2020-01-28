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
<script src="/StudentLogger/js/searchFunctions.js"></script>
<script>
  //empty search for classes
  var outputFields = ['Year_group', 'Form_group', 'Subject']
  searchCriterion('#classSearchbar', '#classSelect', '#classCriterion', 'class', 'Class_ID', outputFields, true);
</script>
</html>
