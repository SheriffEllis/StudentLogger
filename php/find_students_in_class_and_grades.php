<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  //TODO: Get actual values

  //acquire the pupil id, first name, and last name of every student in the class
  $Class_ID = $_POST['Class_ID'];
  $sql = 'SELECT Pupil_ID, Student_ID FROM pupil WHERE Class_ID='.$Class_ID;
  $pupil_results = $conn->query($sql);
  $students = array();
  while($pupil_result = $pupil_results->fetch_assoc()){
    $sql = 'SELECT First_name, Last_name FROM student WHERE Student_ID='.$pupil_result['Student_ID'];
    $name_result = $conn->query($sql);
    $names = $name_result->fetch_assoc();
    $fullname = $names['First_name'].' '.$names['Last_name'];
    //associate pupil id with student's full name
    $students[$pupil_result['Pupil_ID']] = $fullname;
  }

  $Format_ID = $_POST['Format_ID'];
  $sql = 'SELECT Symbol FROM format WHERE Format_ID='.$Format_ID.' ORDER BY Value DESC';
  $grade_results = $conn->query($sql);
  $grades = array();
  while($grade_result = $grade_results->fetch_assoc()){
    array_push($grades, $grade_result['Symbol']);
  }

  echo json_encode(array('students'=>$students, 'grades'=>$grades));
?>
