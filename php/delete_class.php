<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Class_ID = $_POST['Class_ID'];

  $stmt = $conn->prepare('DELETE FROM class WHERE Class_ID=?');
  $stmt->bind_param('i', $Class_ID);
  $stmt->execute();
  $stmt->close();

  $stmt = $conn->prepare('SELECT Pupil_ID FROM pupil WHERE Class_ID=?');
  $stmt->bind_param('i', $Class_ID);
  $stmt->execute();
  $stmt->bind_result($Pupil_ID);
  $stmt->fetch();
  $stmt->close();
  $stmt = $conn->prepare('DELETE FROM grade WHERE Pupil_ID=?');
  $stmt->bind_param('i', $Pupil_ID);
  $stmt->execute();
  $stmt->close();

  $stmt = $conn->prepare('DELETE FROM pupil WHERE Class_ID=?');
  $stmt->bind_param('i', $Class_ID);
  $stmt->execute();
  $stmt->close();

  $conn->close();
?>
