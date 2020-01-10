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
  $conn->close();

  require($current_path . '/templates/navbar.php');
  require($current_path . '/templates/entering_student_data.php')
?>

  <div id="buffer-box"></div>
</body>
</html>
