<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Dataset_IDs = $_POST['Dataset_IDs'];

  $stmt = $conn->prepare('SELECT Value_name FROM dataset WHERE Dataset_ID=?');
  $stmt->bind_param('i', $Dataset_ID);
  $stmt->bind_result($Dataset_name);
  $Dataset_names = array();
  foreach($Dataset_IDs as $ID){
    $Dataset_ID = $ID;
    $stmt->execute();
    $stmt->fetch();
    $Dataset_names[$ID] = $Dataset_name;
  }
  $stmt->close();
  $conn->close();

  echo json_encode($Dataset_names);
?>
