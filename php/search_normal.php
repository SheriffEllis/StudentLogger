<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $table = $_POST['table'];
  $inputField = $_POST['inputField'];
  $outputField = $_POST['outputField'];
  //search for string similar to what was entered (denoted by %'s)
  $searchString = '%' . (string)$_POST['searchString'] . '%';

  $sql = 'SELECT '.$outputField.' FROM '.$table.' WHERE '.$inputField.' LIKE ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $searchString);
  $stmt->execute();
  $stmt->bind_result($result);
  $output = array();
  while($stmt->fetch()){
    array_push($output, $result);
  }
  $stmt->close();
  $conn->close();

  //encode values into a json file that is returned to the jquery made on page
  echo json_encode($output);
?>
