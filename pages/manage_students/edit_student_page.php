<?php
  session_start();
  $title = 'Edit Student';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $fields = array(); //array to fill with field names
  $values = array(); //array to fill with values corresponding to fields for existing student

  //Each fetched row has keys: Field, Type, Null, Key, Default, Extra
  $sql = 'SHOW COLUMNS FROM student';
  $get_fields = $conn->query($sql);
  while($row = $get_fields->fetch_assoc()){
    array_push($fields, $row['Field']);
  }

  $Student_ID = $_POST['Student_ID'];
  $stmt = $conn->prepare('SELECT * FROM student WHERE Student_ID=?');
  $stmt->bind_param('i', $Student_ID);
  $stmt->execute();
  $get_values = $stmt->get_result();
  //fetch only the first row; there shouldn't be more, but if there are, they'll be ignored
  $values = $get_values->fetch_assoc(); //Associative array of values
  $stmt->close();
  $conn->close();

  require($current_path . '/templates/navbar.php');
  require($current_path . '/templates/entering_student_data.php')
?>

  <div id="buffer-box"></div>
</body>
</html>
