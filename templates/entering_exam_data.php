<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }
?>

  <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <?php
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
  ?>

    <!-- TODO: pre-enter data for edit page -->

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

    <div class="container rounded-box" id="gradeBox">
      <div class="row row-padded label-text text-center">
        Grades
      </div>
      <div class="row row-padded output-text text-center">
        <!-- Display and select grade formats -->
        <select id="format" onchange="renderGrades()" required>
          <option value="" disabled selected hidden>Format</option>
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

              echo '<option value="'.$id.'">('.$max_grade.') => ('.$min_grade.')</option>';
            }
          ?>
        </select>
      </div>
      <div id="gradeSelections">
        <!-- Student grade selection is appended here by javascript -->
      </div>
      <div id="buffer-box"></div>
    </div>

    <div class="row row-padded text-center">
      <!-- TODO: create/edit exam script -->
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
  //empty search for classes
  var outputFields = ['Year_group', 'Form_group', 'Subject']
  searchCriterion('#classSearchbar', '#classSelect', '#classCriterion', 'class', 'Class_ID', outputFields, true);

  renderGradeBox();
</script>
