<?php
  session_start();
  $title = 'Create Class';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $fields = array(); //array to fill with field names

  //Each fetched row has keys: Field, Type, Null, Key, Default, Extra
  $sql = 'SHOW COLUMNS FROM class';
  $get_fields = $conn->query($sql);
  while($row = $get_fields->fetch_assoc()){
    array_push($fields, $row['Field']);
  }

  //TODO: Data validation (optional)
  //if data has been submitted
  if(!empty($_POST['Subject'])){
    //Enter known fields into class (Class_ID is autoincremented)
    $Subject = $_POST['Subject'];
    $Year_group = $_POST['Year_group'];
    $Form_group = $_POST['Form_group'];
    $sql = 'INSERT INTO class (Subject, Year_group, Form_group)
      VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sis', $Subject, $Year_group, $Form_group);
    $stmt->execute();
    $stmt->close();

    header("Location: /StudentLogger/pages/manage_students/manage_students_page.php");
  }else{
    require($current_path . '/templates/navbar.php');
    require($current_path . '/templates/entering_student_data.php');
  }
  $conn->close();
?>

  <div id="buffer-box"></div>
</body>
</html>
