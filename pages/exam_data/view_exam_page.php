<?php
  session_start();
  $title = 'View Exam';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Paper = $_POST['Paper'];

  //Retrieve exam data
  //Date and Format_ID
  $sql = 'SELECT Date, Format_ID FROM grade WHERE Paper=? LIMIT 1';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $Paper);
  $stmt->execute();
  $stmt->bind_result($Date, $Format_ID);
  $stmt->fetch();
  $stmt->close();

  //Grades associated with pupil ids
  $sql = 'SELECT Pupil_ID, Grade FROM grade WHERE Paper=?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $Paper);
  $stmt->execute();
  $stmt->bind_result($Pupil_ID, $Grade);
  $Pupil_Grades = array();
  while($stmt->fetch()){
    $Pupil_Grades[$Pupil_ID] = $Grade;
  }
  $stmt->close();

  //Grades associated with student full names
  $Student_Grades = array();
  foreach($Pupil_Grades as $Pupil_ID => $Grade){
    $sql = 'SELECT Student_ID FROM pupil WHERE Pupil_ID='.$Pupil_ID.' LIMIT 1';
    $student_result = $conn->query($sql);
    $student = $student_result->fetch_assoc();
    $Student_ID = $student['Student_ID'];

    $sql = 'SELECT First_name, Last_name FROM student WHERE Student_ID='.$Student_ID.' LIMIT 1';
    $names_result = $conn->query($sql);
    $names = $names_result->fetch_assoc();
    $fullname = $names['First_name'].' '.$names['Last_name'];

    $Student_Grades[$fullname] = $Grade;
  }

  //Format String
  //Max Grade
  $sql = 'SELECT MAX(Value) AS Max_value FROM format WHERE Format_ID='.$Format_ID;
  $results = $conn->query($sql);
  $row = $results->fetch_assoc();
  $max_value = $row['Max_value'];
  $sql = 'SELECT Symbol FROM format WHERE Value='.$max_value.' AND Format_ID='.$Format_ID;
  $results = $conn->query($sql);
  $row = $results->fetch_assoc();
  $max_grade = $row['Symbol'];
  //Min Grade
  $sql = 'SELECT MIN(Value) AS Min_value FROM format WHERE Format_ID='.$Format_ID;
  $results = $conn->query($sql);
  $row = $results->fetch_assoc();
  $min_value = $row['Min_value'];
  $sql = 'SELECT Symbol FROM format WHERE Value='.$min_value.' AND Format_ID='.$Format_ID;
  $results = $conn->query($sql);
  $row = $results->fetch_assoc();
  $min_grade = $row['Symbol'];
  $Format_String = 'From '.$max_grade.' to '.$min_grade;

  require($current_path . '/templates/navbar.php');
?>

  <div class="container">
    <div class="row text-center">
      <a class="btn btn-primary btn-regular col-centered" href="exam_data_page.php">Back</a>
    </div>

    <!-- Display exam paper name and date -->
    <div class="row row-padded text-center output-text">
      <b>Paper:</b> <?php echo $Paper; ?>
    </div>
    <div class="row row-padded text-center output-text">
      <b>Date:</b> <?php echo $Date; ?>
    </div>
    <div class="row row-padded text-center output-text">
      <b>Graded:</b> <?php echo $Format_String; ?>
    </div>

    <!-- Display student names and exam grades -->
    <div class="row row-padded">
      <div class="col-lg-8 col-centered rounded-box tb-padding">
        <?php
          foreach($Student_Grades as $field => $value){
            echo '
            <div class="row">
              <div class="col-lg-6 text-right output-text unknown-length bold">
                ' . $field . ':
              </div>
              <div class="col-lg-6 text-left output-text unknown-length">
                ' . $value . '
              </div>
            </div>
            ';
          }
        ?>
      </div>
  </div>

  <div id="buffer-box"></div>
</body>
</html>
