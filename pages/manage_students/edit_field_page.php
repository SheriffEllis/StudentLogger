<?php
  session_start();
  $title = 'Edit Student Fields';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $fields = array(); //array to fill with field names
  $values = array(); //array to fill with values corresponding to fields for existing student fields

  //Each fetched row has keys: Field, Type, Null, Key, Default, Extra
  $sql = 'SHOW COLUMNS FROM student_field';
  $get_fields = $conn->query($sql);
  while($row = $get_fields->fetch_assoc()){
    array_push($fields, $row['Field']);
  }

  //TODO: insert actual student field ID selected from manage student field page
  $Field_ID = 1;
  $stmt = $conn->prepare('SELECT * FROM student_field WHERE Field_ID=?');
  $stmt->bind_param('i', $Field_ID);
  $stmt->execute();
  $get_values = $stmt->get_result();
  //fetch only the first row; there shouldn't be more, but if there are, they'll be ignored
  $values = $get_values->fetch_assoc(); //Associative array of values
  $stmt->close();
  $conn->close();

  require($current_path . '/templates/navbar.php');
  //TODO: make student_fields update the student table's fields
  require($current_path . '/templates/entering_student_data.php')
?>

  <div id="buffer-box"></div>
</body>
</html>
