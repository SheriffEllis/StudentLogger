<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Data_table_ID = $_POST['Data_table_ID'];

  $stmt = $conn->prepare('SELECT Table_description FROM data_table WHERE Data_table_ID=? LIMIT 1');
  $stmt->bind_param('i', $Data_table_ID);
  $stmt->execute();
  $stmt->bind_result($description);
  $stmt->fetch();
  $stmt->close();

  $stmt = $conn->prepare('SELECT Value_name FROM dataset WHERE Data_table_ID=?');
  $stmt->bind_param('i', $Data_table_ID);
  $stmt->execute();
  $stmt->bind_result($column);
  $columns = array();
  while($stmt->fetch()){
    array_push($columns, $column);
  }
  $columns_string = implode(', ', $columns);

  $conn->close();

  echo json_encode(array('description'=>$description, 'columns'=>$columns_string));
?>
