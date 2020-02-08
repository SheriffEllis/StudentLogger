<?php
  session_start();
  $title = 'Create Exam';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  if(!empty($_POST['Paper'])){
    $Paper = $_POST['Paper'];
    $Date = $_POST['Date'];
    $Format_ID = $_POST['Format_ID'];
    $Pupil_Grades = $_POST['Pupil_Grades'];

    //Create exam
    $sql = 'INSERT INTO grade (Paper, Date, Format_ID, Pupil_ID, Grade)
      VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssiis', $Paper, $Date, $Format_ID, $Pupil_ID, $Grade);
    foreach($Pupil_Grades as $pupil_ID => $grade){
      //set bound parameters to values of local loop variables
      $Pupil_ID = $pupil_ID;
      $Grade = $grade;
      $stmt->execute();
    }
    $stmt->close();
    
    include($current_path . "/php/publish_notifications.php");
    publishNotifications($conn, $Paper, $Format_ID, $Pupil_Grades);

    header('Location: /StudentLogger/pages/exam_data/exam_data_page.php');
  }else{
    require($current_path . '/templates/navbar.php');
    require($current_path . '/templates/entering_exam_data.php');
  }
?>

  <div id="buffer-box"></div>
</body>
</html>
