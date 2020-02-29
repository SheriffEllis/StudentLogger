  <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <?php
    if(empty($_POST['Paper'])){
      //Class Query Box
      $is_container = true;
      $label = 'Select Class';
      $id_searchbar = 'classSearchbar';
      $id_selection = 'classSelect';
      $id_criteriabox = 'classCriterion';

      //retrieve fields of class as criteria
      $search_criteria = array();
      $sql = 'SHOW COLUMNS FROM class';
      $get_fields = $conn->query($sql);
      while($row = $get_fields->fetch_assoc()){
        array_push($search_criteria, $row['Field']);
      }

      $select_script = 'renderGradeBox()';
      $outputFields = "['Year_group', 'Form_group', 'Subject']";
      $search_script = "searchCriterion('#$id_searchbar', '#$id_selection', '#$id_criteriabox', 'class', 'Class_ID', $outputFields)";
      require($current_path . '/templates/query_box_template.php');
    }else{
      echo '
        <select id="classSelect" style="display: none;">
          <option val="'.$Class_ID.'" selected>'.$Class_ID.'</option>
        </select>
      ';
    }
  ?>

    <div class="container">
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="Paper">Paper Name:</label>
        <input class="vertical-text-padding output-text col-lg-3" placeholder="Enter paper name" name="Paper" type="text"
          required <?php if(!empty($Paper)){echo 'value="'.$Paper.'" readonly';} ?>></input>
      </div>
      <div class="row row-padded">
        <label class="label-text text-right col-lg-6" for="Date">Date of Exam:</label>
        <input class="vertical-text-padding output-text col-lg-3" name="Date" type="date"
        required <?php if(!empty($Paper)){echo 'value="'.$Date.'"';} ?> ></input>
      </div>
    </div>

    <div id="buffer-box"></div>

    <div class="container rounded-box" id="gradeBox">
      <div class="row row-padded label-text text-center">
        Grades
      </div>
      <div class="row row-padded output-text text-center">
        <!-- Display and select grade formats -->
        <select id="format" name="Format_ID" onchange="renderGrades()" required>
          <!-- disabled option is selected in create mode, database grade format is selected in edit mode -->
          <option selected
          <?php
            if(empty($Paper)){
              echo 'value="" hidden disabled>Select Grade Format';
            }else{
              echo 'value="'.$Format_ID.'">(keep grade format)';
            }
          ?>
          </option>
          <?php
            $sql = 'SELECT Format_ID FROM format';
            $results = $conn->query($sql);
            $format_ids = array();
            while($row = $results->fetch_assoc()){
              array_push($format_ids, $row['Format_ID']);
            }
            //make one record of id for each type of format
            $format_ids = array_unique($format_ids);

            foreach($format_ids as $id){
              $sql = 'SELECT MAX(Value) AS Max_value FROM format WHERE Format_ID='.$id;
              $results = $conn->query($sql);
              $row = $results->fetch_assoc();
              $max_value = $row['Max_value'];
              $sql = 'SELECT Symbol FROM format WHERE Value='.$max_value.' AND Format_ID='.$id;
              $results = $conn->query($sql);
              $row = $results->fetch_assoc();
              $max_grade = $row['Symbol'];

              $sql = 'SELECT MIN(Value) AS Min_value FROM format WHERE Format_ID='.$id;
              $results = $conn->query($sql);
              $row = $results->fetch_assoc();
              $min_value = $row['Min_value'];
              $sql = 'SELECT Symbol FROM format WHERE Value='.$min_value.' AND Format_ID='.$id;
              $results = $conn->query($sql);
              $row = $results->fetch_assoc();
              $min_grade = $row['Symbol'];

              echo '<option value="'.$id.'">('.$max_grade.') to ('.$min_grade.')</option>';
            }
          ?>
        </select>
      </div>
      <div id="gradeSelections">
        <!-- Student grade selection is appended here by javascript -->
        <!-- TODO: re-enter student grades? -->
      </div>
      <div id="buffer-box"></div>
    </div>

    <div class="row row-padded text-center">
      <button class="btn btn-success btn-regular" type="submit">Save</button>
      <a class="btn btn-danger btn-regular" href="exam_data_page.php">Cancel</a>
    </div>
  </form>
<?php
  $conn->close();
?>
<script src="/StudentLogger/js/enteringExamDataFunctions.js"></script>
<script src="/StudentLogger/js/searchFunctions.js"></script>
<script>
  //empty search for classes if not in edit mode
  if(!$('#classSelect').val()){
    var outputFields = ['Year_group', 'Form_group', 'Subject']
    searchCriterion('#classSearchbar', '#classSelect', '#classCriterion', 'class', 'Class_ID', outputFields, true);
  }

  renderGradeBox();
</script>
