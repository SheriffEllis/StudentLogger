<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $userId = $_POST['userId'];
  $classId = $_POST['classId'];

  $stmt = $conn->prepare('UPDATE class SET Username=? WHERE Class_ID=?');
  $stmt->bind_param('si', $userId, $classId);
  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
