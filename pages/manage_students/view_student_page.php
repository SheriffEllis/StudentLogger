<?php
  session_start();
  $title = 'View Student';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $values = array(); //array to fill with values corresponding to fields for existing student

  $Student_ID = $_POST['Student_ID'];
  $stmt = $conn->prepare('SELECT * FROM student WHERE Student_ID=?');
  $stmt->bind_param('i', $Student_ID);
  $stmt->execute();
  $get_values = $stmt->get_result();
  //fetch only the first row; there shouldn't be more, but if there are, they'll be ignored
  $values = $get_values->fetch_assoc(); //Associative array of values
  $stmt->close();
  $conn->close();

  require($current_path . '/templates/navbar.php');
?>

  <div class="container">
    <div class="row text-center">
      <a class="btn btn-primary btn-regular col-centered" href="manage_students_page.php">Back</a>
    </div>

    <!-- Display student first and last name as title -->
    <div class="row row-padded text-center">
      <label class="label-text"><?php echo $values['First_name'] . ' ' . $values['Last_name']; ?></label>
    </div>

    <!-- Display student's field and values -->
    <div class="row row-padded">
      <div class="col-lg-6 rounded-box tb-padding">
        <?php
          foreach($values as $field => $value){
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

      <!-- Display student's classes -->
      <div class="col-lg-6 rounded-box">
        <div class="row row-padded">
          <div class="output-text bold col-lg-3 text-right">Classes:</div>
          <div class="scrollbox box" style="width: 400px;">
            <!-- TODO: return actual classes from database -->
            13ENG, 12ENG, 13ECO
          </div>
        </div>
        <div class="row row-padded"></div><!-- padding for aesthetic purpose -->
      </div>
    </div>
  </div>

  <div id="buffer-box"></div>
</body>
</html>
