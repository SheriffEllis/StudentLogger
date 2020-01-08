<?php
  session_start();
  $title = 'View Student';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>

  <div class="container">
    <div class="row text-center">
      <a class="btn btn-primary col-lg-1 col-centered" href="manage_students_page.php">Back</a>
    </div>

    <div class="row row-padded text-center">
      <!-- TODO: insert student's name into label -->
      <label id="student_name" class="label-text">[Student name]</label>
    </div>

    <div class="row row-padded">
        <!-- TODO: substitute with real database values -->
        <div class="col-lg-6 rounded-box tb-padding">
          <div class="row">
            <div class="col-lg-6 text-right output-text unknown-length bold">
              First_name:
            </div>
            <div class="col-lg-6 text-left output-text unknown-length">
              Value
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 text-right output-text unknown-length bold">
              Last_name:
            </div>
            <div class="col-lg-6 text-left output-text unknown-length">
              Value
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 text-right output-text unknown-length bold">
              Year_group:
            </div>
            <div class="col-lg-6 text-left output-text unknown-length">
              Value
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 text-right output-text unknown-length bold">
              Field1:
            </div>
            <div class="col-lg-6 text-left output-text unknown-length">
              Value
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 text-right output-text unknown-length bold">
              Field2:
            </div>
            <div class="col-lg-6 text-left output-text unknown-length">
              Value
            </div>
          </div>
        </div>

        <div class="col-lg-6 rounded-box">
          <div class="row row-padded">
            <div class="output-text bold col-lg-3 text-right">Classes:</div>
            <div class="scrollbox box col-lg-8">
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
