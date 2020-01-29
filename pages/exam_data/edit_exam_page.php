<?php
  session_start();
  $title = 'Edit Exam';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  //TODO: re-enter data from selected exam

  $Paper = $_POST['Paper'];
  //checks for Date rather than Paper because Paper is given by editExam script
  if(!empty($_POST['Date'])){
    $Date = $_POST['Date'];
    $Format_ID = $_POST['Format_ID'];
    $Pupil_Grades = $_POST['Pupil_Grades'];
    $sql = 'UPDATE grade SET Date=?, Format_ID=?, Grade=? WHERE Paper=? AND Pupil_ID=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sissi', $Date, $Format_ID, $Grade, $Paper, $Pupil_ID);
    foreach($Pupil_Grades as $pupil_ID => $grade){
      //set bound parameters to values of local loop variables
      $Pupil_ID = $pupil_ID;
      $Grade = $grade;
      $stmt->execute();
    }
    $stmt->close();

    header('Location: /StudentLogger/pages/exam_data/exam_data_page.php');
  }else{

    $sql = "SELECT Pupil_ID, Date, Format_ID FROM grade WHERE Paper='".$Paper."' LIMIT 1";
    $results = $conn->query($sql);
    $row = $results->fetch_assoc();
    $Pupil_ID = $row['Pupil_ID'];
    $Date = $row['Date'];
    $Format_ID = $row['Format_ID'];

    //use one pupil from the exam to use to find the class
    $sql = "SELECT Class_ID FROM pupil WHERE Pupil_ID=".$Pupil_ID." LIMIT 1";
    $results = $conn->query($sql);
    $row = $results->fetch_assoc();
    $Class_ID = $row['Class_ID'];

    require($current_path . '/templates/navbar.php');
    require($current_path . '/templates/entering_exam_data.php');
  }
?>

  <div id="buffer-box"></div>
</body>
</html>
