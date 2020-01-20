<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $privilege = $_POST['privilege'];
  $usr = $_POST['usr'];

  //Update the privilege of the selected user
  $stmt = $conn->prepare('UPDATE teacher SET Privilege=? WHERE Username=?');
  $stmt->bind_param('is', $privilege, $usr);
  $stmt->execute();
  $stmt->close();
?>
