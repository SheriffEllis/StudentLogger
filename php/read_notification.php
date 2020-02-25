<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Notification_ID = $_POST['Notification_ID'];
  $sql = "UPDATE grade_notification SET isRead=true WHERE Notification_ID=$Notification_ID";
  $conn->query($sql);
  $conn->close();
?>
