<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $criterion = $_POST['criterion'];
  //search for string similar to what was entered (denoted by %'s)
  $searchString = '%' . (string)$_POST['searchString'] . '%';

  $papers = array();
  switch($criterion){
    case 'Paper':
    case 'Date':
      //Regular search for corresponding Paper
      $sql = 'SELECT Paper FROM grade WHERE '.$criterion.' LIKE ?';
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $searchString);
      $stmt->execute();
      $stmt->bind_result($result);
      while($stmt->fetch()){
        array_push($papers, $result);
      }
      $stmt->close();
    break;
    case 'Student_ID':
      //Search first for Pupils referring to Student_ID
      $pupils = array();
      $sql = 'SELECT Pupil_ID FROM pupil WHERE Student_ID LIKE ?';
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $searchString);
      $stmt->execute();
      $stmt->bind_result($result);
      while($stmt->fetch()){
        array_push($pupils, $result);
      }
      $stmt->close();

      //Then search for grades using pupil ids
      $sql = 'SELECT Paper FROM grade WHERE Pupil_ID=?';
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $Pupil_ID);
      $stmt->bind_result($result);
      foreach($pupils as $pupil){
        $Pupil_ID = $pupil;
        $stmt->execute();
        $stmt->fetch();
        if($result != null){
          array_push($papers, $result);
          $result = null; //reset
        }
      }
      $stmt->close();
    break;
    default: echo 'Error';
  }
  $conn->close();

  //remove any repeats of the same paper
  $papers = array_unique($papers);

  //encode values into a json file that is returned to the jquery made on page
  echo json_encode($papers);
?>
