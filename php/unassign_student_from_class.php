<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Class_ID = $_POST['Class_ID'];
  $Student_ID = $_POST['Student_ID'];

  //Check if pupil exists
  $sql = 'SELECT Pupil_ID FROM pupil WHERE Class_ID=? AND Student_ID=?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $Class_ID, $Student_ID);
  $stmt->execute();
  $stmt->bind_result($result);
  $stmt->fetch();
  $stmt->close();

  if($result == null){
    echo 'notexist';
  }else{
    $stmt = $conn->prepare('DELETE FROM pupil WHERE Class_ID=? AND Student_ID=?');
    $stmt->bind_param('ii', $Class_ID, $Student_ID);
    $stmt->execute();
    $stmt->close();
    echo 'success';
  }

  $conn->close();
?>
