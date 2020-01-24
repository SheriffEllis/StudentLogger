<?php
  //TODO: remove all instances of class from database?
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Class_ID = $_POST['Class_ID'];

  $stmt = $conn->prepare('DELETE FROM class WHERE Student_ID=?');
  $stmt->bind_param('i', $Class_ID);
  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
