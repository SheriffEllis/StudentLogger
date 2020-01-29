<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Paper = $_POST['Paper'];

  $stmt = $conn->prepare('DELETE FROM grade WHERE Paper=?');
  $stmt->bind_param('s', $Paper);
  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
