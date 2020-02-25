<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Function_ID = $_POST['Function_ID'];

  $stmt = $conn->prepare('DELETE FROM function WHERE Function_ID=?');
  $stmt->bind_param('i', $Function_ID);
  $stmt->execute();
  $stmt->close();

  $stmt = $conn->prepare('DELETE FROM dataset WHERE Function_ID=?');
  $stmt->bind_param('i', $Function_ID);
  $stmt->execute();
  $stmt->close();

  $conn->close();
?>
