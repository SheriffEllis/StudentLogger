<?php
  session_start();
  $title = 'Manage Students Page';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  //Acquire user's privilege
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
  $conn->close();

  require($current_path . '/templates/navbar.php');

  //Student Query Box
  $is_container = true;
  $label = 'Select Student';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('Student1', 'Student2', 'Student3');
  //TODO: substitute actual code in the buttons
  /*
  <div class="row row-padded">
    <div class="col-lg-4"></div>
    <button class="col-lg-1 btn btn-success" type="button">Add Student</button>
    <button class="col-lg-1 btn btn-warning" type="button">Edit Student</button>
    <button class="col-lg-1 btn btn-danger" type="button">Remove Student</button>
    <button class="col-lg-1 btn btn-primary" type="button">View Student</button>
  </div>
  */
  $buttons = '
  <div class="text-center">
    <a class="btn-regular btn btn-success" href="create_student_page.php">Add Student</a>
    <a class="btn-regular btn btn-warning" href="edit_student_page.php">Edit Student</a>
    <a class="btn-regular btn btn-danger" href="">Remove Student</a>
    <a class="btn-regular btn btn-primary" href="view_students_page.php">View Student</a>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>

<?php
  //Class Query Box
  //TODO: Box next to this displaying members of the class?
  $is_container = true;
  $label = 'Select Class';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('13ENG', '12ENG', '13ECO');
  $buttons = '
  <div class="text-center">
    <a class="btn-regular btn btn-success" href="create_class_page.php">Add Class</a>
    <a class="btn-regular btn btn-warning" href="edit_class_page.php">Edit Class</a>
    <a class="btn-regular btn btn-danger" href="">Remove Class</a>
    <a class="btn-regular btn btn-success" href="">Assign Student</a>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>

<?php
  //(Admin only) Edit Student Data Fields Query Box
  if($privilege <= 0){
    $is_container = true;
    $label = 'Edit Student Data Fields';
    $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
    $options = array('Age', 'First_name', 'Last_name');
    $buttons = '
    <div class="text-center">
      <a class="btn-regular btn btn-success" href="create_field_page.php">Add Field</a>
      <a class="btn-regular btn btn-warning" href="edit_field_page.php">Edit Field</a>
      <a class="btn-regular btn btn-danger" href="">Remove Field</a>
    </div>
    ';
    require($current_path . '/templates/query_box_template.php');
  }
?>

  <div id="buffer-box"></div>
</body>
</html>
