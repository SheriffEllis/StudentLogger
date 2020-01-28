<?php
  session_start();
  $title = 'Exam Data Page';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');

  //Exam Query Box
  $is_container = true;
  $label = 'Select Exam';
  $id_searchbar = 'examSearchbar';
  $id_selection = 'examSelect';
  $id_criteriabox = 'examCriterion';

  //Specific criteria that are proccessed differently for exam search
  $search_criteria = array('Paper', 'Student_ID', 'Date');

  $search_script = "searchExam('#$id_searchbar', '#$id_selection', '#$id_criteriabox')";

  //TODO: edit exam, remove exam, view exam
  $buttons = '
  <div class="text-center">
    <a class="btn-regular btn btn-success" href="create_exam_page.php">Add Exam</a>
    <button class="btn-regular btn btn-warning" onclick="editExam()">Edit Exam</button>
    <button class="btn-regular btn btn-danger" onclick="removeExam()">Remove Exam</button>
    <button class="btn-regular btn btn-primary" onclick="viewExam()">View Exam</button>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/examDataFunctions.js"></script>
<script>
  //blank search on page open
  searchExam('#examSearch', '#examSelect', '#examCriterion', true);
</script>
</html>
