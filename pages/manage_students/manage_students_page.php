<?php
  session_start();
  $title = 'Manage Students Page';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  //Acquire user's privilege to determine if edit fields should be displayed
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }
  $usr = $_SESSION['usr'];
  $stmt = $conn->prepare("SELECT Privilege FROM teacher WHERE Username=? LIMIT 1");
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($privilege);
  $stmt->fetch();
  $stmt->close();

  require($current_path . '/templates/navbar.php');

  //Student Query Box
  $is_container = true;
  $label = 'Select Student';
  $id_searchbar = 'studentSearchbar';
  $id_selection = 'studentSelect';
  $id_criteriabox = 'studentCriterion';

  //retrieve fields of student as criteria
  $search_criteria = array();
  $sql = 'SHOW COLUMNS FROM student';
  $get_fields = $conn->query($sql);
  while($row = $get_fields->fetch_assoc()){
    array_push($search_criteria, $row['Field']);
  }

  $outputFields = "['First_name', 'Last_name']";
  $search_script = "searchCriterion('#$id_searchbar', '#$id_selection', '#$id_criteriabox', 'student', 'Student_ID', $outputFields)";
  $buttons = '
  <div class="text-center">
    <a class="btn-regular btn btn-success" href="create_student_page.php">Add Student</a>
    <button class="btn-regular btn btn-warning" onclick="editStudent()">Edit Student</button>
    <button class="btn-regular btn btn-danger" onclick="removeStudent()">Remove Student</button>
    <button class="btn-regular btn btn-primary" onclick="viewStudent()">View Student</button>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>

<?php
  //Class Query Box
  $is_container = true;
  $label = 'Select Class';
  $id_searchbar = 'classSearchbar';
  $id_selection = 'classSelect';
  $id_criteriabox = 'classCriterion';

  //retrieve fields of class as criteria
  $search_criteria = array();
  $sql = 'SHOW COLUMNS FROM class';
  $get_fields = $conn->query($sql);
  while($row = $get_fields->fetch_assoc()){
    array_push($search_criteria, $row['Field']);
  }

  $outputFields = "['Year_group', 'Form_group', 'Subject']";
  $search_script = "searchCriterion('#$id_searchbar', '#$id_selection', '#$id_criteriabox', 'class', 'Class_ID', $outputFields)";
  $buttons = '
  <div class="text-center">
    <a class="btn-regular btn btn-success" href="create_class_page.php">Add Class</a>
    <button class="btn-regular btn btn-warning" onclick="editClass()">Edit Class</button>
    <button class="btn-regular btn btn-danger" onclick="removeClass()">Remove Class</button>
  </div>
  <div class="text-center row-padded">
    <button class="btn-regular btn btn-success" onclick="assignStudentToClass()">Assign Student</button>
    <button class="btn-regular btn btn-danger" onclick="unassignStudentFromClass()">Unassign Student</button>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');

  $conn->close();
?>

  <!-- TODO: add view class section? -->

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/searchFunctions"></script>
<script src="/StudentLogger/js/manageStudentsFunctions.js"></script>
<script>
//student initial blank search
var outputFields = ['First_name', 'Last_name'];
searchCriterion('#studentSearchbar', '#studentSelect', '#studentCriterion', 'student', 'Student_ID', outputFields, true);
//class initial blank search
var outputFields = ['Year_group', 'Form_group', 'Subject']
searchCriterion('#classSearchbar', '#classSelect', '#classCriterion', 'class', 'Class_ID', outputFields, true);
//student fields blank search
searchNormal('#fieldSearchbar','#fieldSelect','student_field','Field_ID','Field_name');
</script>
</html>
