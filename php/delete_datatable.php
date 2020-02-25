<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Data_table_ID = $_POST['Data_table_ID'];

  $stmt = $conn->prepare('DELETE FROM data_table WHERE Data_table_ID=?');
  $stmt->bind_param('i', $Data_table_ID);
  $stmt->execute();
  $stmt->close();

  $stmt = $conn->prepare('DELETE FROM dataset WHERE Data_table_ID=?');
  $stmt->bind_param('i', $Data_table_ID);
  $stmt->execute();
  $stmt->close();
  
  $conn->close();
?>
