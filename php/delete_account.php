<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $usr = $_POST['usr'];

  $stmt = $conn->prepare('DELETE FROM teacher WHERE Username=?');
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->close();

  $stmt = $conn->prepare('UPDATE class SET Username=null WHERE Username=?');
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->close();

  $conn->close();
?>
