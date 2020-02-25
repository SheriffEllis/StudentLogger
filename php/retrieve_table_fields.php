<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $table = $_POST['table'];
  $sql = 'SHOW COLUMNS FROM '.$table;
  $get_fields = $conn->query($sql);
  $table_fields = array();
  while($row = $get_fields->fetch_assoc()){
    array_push($table_fields, $row['Field']);
  }
  $conn->close();

  echo json_encode($table_fields);
?>
