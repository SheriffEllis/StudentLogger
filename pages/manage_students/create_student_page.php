<?php
  session_start();
  $title = 'Create Student';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $fields = array(); //array to fill with field names

  //Each fetched row has keys: Field, Type, Null, Key, Default, Extra
  $sql = 'SHOW COLUMNS FROM student';
  $get_fields = $conn->query($sql);
  while($row = $get_fields->fetch_assoc()){
    array_push($fields, $row['Field']);
  }

  //TODO: data validation (optional)
  //if data has been submitted
  if(!empty($_POST['First_name'])){
    //Enter known fields into student
    $Student_ID = $_POST['Student_ID'];
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $Email = $_POST['Email'];
    $Year_group = $_POST['Year_group'];
    //TODO: replace age with birthdate
    $Age = $_POST['Age'];
    $Sex = $_POST['Sex'];
    $sql = 'INSERT INTO student (Student_ID, First_name, Last_name, Email, Year_group, Age, Sex)
      VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssiis', $Student_ID, $First_name, $Last_name,
      $Email, $Year_group, $Age, $Sex);
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
