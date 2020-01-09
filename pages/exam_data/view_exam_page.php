<?php
  session_start();
  $title = 'View Exam';
  $web_section = 'exam_data';
  $current_path = getenv('CURRENT_PATH');

  //TODO: Retrive exam data
  $paper_name = 'Exam1';
  $exam_date = '01/01/2020';
  $values = array('Student1' => 'A*', 'Student2' => 'B', 'Student3' => 'D');

  require($current_path . '/templates/navbar.php');
?>

  <div class="container">
    <div class="row text-center">
      <a class="btn btn-primary btn-regular col-centered" href="exam_data_page.php">Back</a>
    </div>

    <!-- Display exam paper name and date -->
    <div class="row row-padded text-center">
      <label class="label-text"><?php echo $paper_name; ?></label>
    </div>
    <div class="row row-padded text-center">
      <label class="label-text"><?php echo $exam_date; ?></label>
    </div>

    <!-- Display student names and exam grades -->
    <div class="row row-padded">
      <div class="col-lg-8 col-centered rounded-box tb-padding">
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
  </div>

  <div id="buffer-box"></div>
</body>
</html>
