<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $usr = $_POST['selectedUser'];

  $stmt = $conn->prepare('SELECT Privilege FROM teacher WHERE Username=? LIMIT 1');
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($privilege);
  $stmt->fetch();
  $stmt->close();

  $stmt = $conn->prepare('SELECT Year_group, Subject, Form_group FROM class WHERE Username=?');
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($year_group, $subject, $form_group);
  $classes = array();
  while($stmt->fetch()){
    $class = 'Y' . $year_group . '(' . $form_group . ')' . $subject;
    array_push($classes, $class);
  }
  $stmt->close();
  $conn->close();

  //encode values into a json file that is returned to the jquery made on page
  echo json_encode(array('privilege'=>$privilege, 'classes'=>$classes));
?>
