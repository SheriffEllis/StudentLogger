<?php
  //TODO: remove all instances of field from database
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Field_ID = $_POST['Field_ID'];

  $stmt = $conn->prepare('DELETE FROM student_field WHERE Field_ID=?');
  $stmt->bind_param('i', $Field_ID);
  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
