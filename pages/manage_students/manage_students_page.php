<?php
  session_start();
  $title = 'Manage Students Page';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  //Acquire user's privilege
  $conn = new mysqli(
    getenv('HTTP_HOST'),
    getenv('HTTP_USER'),
    getenv('HTTP_PASS'),
    getenv('HTTP_DATABASE')
  );
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
  $container = true;
  $label = 'Select Student';
  $id_querybox = 'qBox1';
  $id_searchbar = 'sbar1';
  $id_searchbutton = 'sbut1';
  $id_selection = 'select1';
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
  <div class="row row-padded">
    <div class="col-lg-4"></div>
    <a class="col-lg-1 btn btn-success" href="#">Add Student</a>
    <a class="col-lg-1 btn btn-warning" href="#">Edit Student</a>
    <a class="col-lg-1 btn btn-danger" href="#">Remove Student</a>
    <a class="col-lg-1 btn btn-primary" href="view_students_page.php">View Student</a>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>

<?php
  //Class Query Box
  //TODO: Box next to this displaying memebers of the class?
  $container = true;
  $label = 'Select Class';
  $id_querybox = 'qBox2';
  $id_searchbar = 'sbar2';
  $id_searchbutton = 'sbut2';
  $id_selection = 'select2';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('13ENG', '12ENG', '13ECO');
  $buttons = '
  <div class="row row-padded">
    <div class="col-lg-4"></div>
    <button class="col-lg-1 btn btn-success" type="button">Add Class</button>
    <button class="col-lg-1 btn btn-warning" type="button">Edit Class</button>
    <button class="col-lg-1 btn btn-danger" type="button">Remove Class</button>
    <button class="col-lg-1 btn btn-success" type="button">Assign Student</button>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <div id="buffer-box"></div>

<?php
  //(Admin only) Edit Student Data Fields Query Box
  if($privilege <= 0){
    $container = true;
    $label = 'Edit Student Data Fields';
    $id_querybox = 'qBox3';
    $id_searchbar = 'sbar3';
    $id_searchbutton = 'sbut3';
    $id_selection = 'select3';
    $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
    $options = array('Age', 'First_name', 'Last_name');
    $buttons = '
    <div class="row row-padded">
      <div class="col-lg-4"></div>
      <button class="col-lg-2 btn btn-success" type="button">Add Field</button>
      <button class="col-lg-2 btn btn-danger" type="button">Remove Field</button>
    </div>
    ';
    require($current_path . '/templates/query_box_template.php');
  }
?>

  <div id="buffer-box"></div>
</body>
</html>
