<?php
  //TODO: remove all instances of student from database?
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Student_ID = $_POST['Student_ID'];

  $stmt = $conn->prepare('DELETE FROM student WHERE Student_ID=?');
  $stmt->bind_param('i', $Student_ID);
  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
