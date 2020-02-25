<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $stmt = $conn->prepare("DELETE FROM dataset WHERE isnull(Data_table_ID) AND isnull(Function_ID)");
  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
