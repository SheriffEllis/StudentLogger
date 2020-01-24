<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $table = $_POST['table'];
  $idField = $_POST['idField'];
  $inputField = $_POST['inputField'];
  $outputFields = $_POST['outputFields'];
  //search for string similar to what was entered (denoted by %'s)
  $searchString = '%' . (string)$_POST['searchString'] . '%';

  $ids = array();
  $sql = 'SELECT '.$idField.' FROM '.$table.' WHERE '.$inputField.' LIKE ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $searchString);
  $stmt->execute();
  $stmt->bind_result($result);
  while($stmt->fetch()){
    array_push($ids, $result);
  }
  $stmt->close();

  $returnData = array();
  foreach($ids as $id){
    $outputString = '';
    foreach($outputFields as $outputField){
      $sql = 'SELECT '.$outputField.' FROM '.$table.' WHERE '.$idField.'=?';
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $id);
      $stmt->execute();
      $stmt->bind_result($result);
      $stmt->fetch();
      $outputString = $outputString . $result . ':';
      $stmt->close();
    }
    //remove last ':' character
    $outputString = substr($outputString, 0, -1);
    //assign each id to corresponding custom outputString
    $returnData[$id] = $outputString;
  }
  $conn->close();

  //encode values into a json file that is returned to the jquery made on page
  echo json_encode($returnData);
?>
