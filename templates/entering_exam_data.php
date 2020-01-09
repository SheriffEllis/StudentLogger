<?php
  //Class Query Box
  $is_container = true;
  $label = 'Select Class';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('13ENG', '12ENG', '13ECO');
  require($current_path . '/templates/query_box_template.php');
?>

<!-- TODO: pre-enter data for edit page -->
  <form action="" method="post">
    <div class="container">
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="paper_name">Paper Name:</label>
        <input class="vertical-text-padding output-text col-lg-3" placeholder="Enter paper name" name="paper_name" type="text" required></input>
      </div>
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="exam_date">Date of Exam:</label>
        <input class="vertical-text-padding output-text col-lg-3" name="exam_date" type="date" required></input>
      </div>
    </div>

    <div id="buffer-box"></div>

    <div class="container rounded-box">
      <div class="row row-padded label-text text-center">
        Grades
      </div>
      <div class="row row-padded output-text text-center">
        <!-- TODO: input actual grade formats -->
        <select required>
          <option value="" disabled selected hidden>Format</option>
          <option>A* - E</option>
          <option>A+ - F-</option>
          <option>1 - 9</option>
          <option>1 - 7</option>
        </select>
      </div>

      <!-- TODO: substitue relevant format -->
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="student1">Student1:</label>
        <select class="vertical-text-padding output-text col-lg-2" name="student1" required>
          <option value="" disabled selected hidden>Grade</option>
          <option>A*</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
          <option>D</option>
          <option>E</option>
        </select>
      </div>
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="student2">Student2:</label>
        <select class="vertical-text-padding output-text col-lg-2" name="student2" required>
          <option value="" disabled selected hidden>Grade</option>
          <option>A*</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
          <option>D</option>
          <option>E</option>
        </select>
      </div>
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="student3">Student3:</label>
        <select class="vertical-text-padding output-text col-lg-2" name="student3" required>
          <option value="" disabled selected hidden>Grade</option>
          <option>A*</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
          <option>D</option>
          <option>E</option>
        </select>
      </div>

      <div id="buffer-box"></div>
    </div>

    <div class="row row-padded text-center">
      <!-- TODO: create/edit exam script -->
      <button class="btn btn-success btn-regular" type="submit">Save</button>
      <a class="btn btn-danger btn-regular" href="exam_data_page.php">Cancel</a>
    </div>
  </form>
