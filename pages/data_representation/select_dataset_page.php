<?php
  session_start();
  $title = 'Select Dataset';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Table_title = $_POST['Table_title'];
  $Table_description = $_POST['Table_description'];
  $Dataset_IDs = $_POST['Dataset_IDs'];
  $Dataset_index = $_POST['Dataset_index'];
  $Postback = $_POST['Postback'];

  require($current_path . '/templates/navbar.php');
  /*
  TODO:
    Configure dynamic selection of conditions
    Submit->create dataset->add dataset id to Dataset_IDs->Submit data
    Cancel->Resubmit data
    if user cancels creation of table, all prior created datasets should be deleted
  */
?>

  <form action="<?php echo $Postback; ?>" method="post">
    <div class="container box">
      <div class="row row-padded text-center">
        <select id="tableSelect" onchange="renderOptions()" class="col-centered output-text">
          <option disabled selected hidden>Select Table</option>
          <?php
            //Select all table names except dataset and teacher
            $sql = 'SELECT table_name FROM information_schema.tables
              WHERE table_schema ="student_logger" AND table_name != "dataset" AND table_name != "teacher"';
            $results = $conn->query($sql);
            while($result = $results->fetch_assoc()){
              echo '<option value="'.$result['table_name'].'">'.$result['table_name'].'</option>';
            }
          ?>
        </select>
      </div>

      <div id="outputFieldRow" class="row row-padded text-center" style="display: none;">
        <select id="outputFieldSelect" class="col-centered output-text">
        </select>
      </div>

      <div id="orderDeterminingRow" class="row row-padded text-center" style="display: none;">
        <select id="orderDeterminingFieldSelect" class="output-text">
        </select>
        <select class="output-text">
          <option disabled selected hidden>Order</option>
          <option value="true">Ascending</option>
          <option value="false">Descending</option>
        </select>
      </div>

      <!-- First condition box -->
      <!-- TODO: implement dynamic adding of more condition boxes -->
      <div class="row row-padded">
        <div class="col-lg-8 col-centered box">
          <div class="row row-padded label-text text-center">
            <label>Condition 1</label>
            <input class="mediumCheckbox" type="checkbox"></input>
          </div>

          <div class="row row-padded text-center">
            <select class="output-text">
              <option disabled selected hidden>Investigated Field</option>
              <option>Field1</option>
              <option>Field2</option>
              <option>Field3</option>
            </select>
          </div>

          <!-- with adequete comparators, the "not" option isn't necessary -->

          <div class="row row-mid-padded text-center">
            <select class="output-text">
              <option disabled selected hidden>Comparator</option>
              <option> == </option>
              <option> != </option>
              <option> <  </option>
              <option> <= </option>
              <option> >  </option>
              <option> => </option>
            </select>
          </div>

          <div class="row row-mid-padded">
            <p class="col-lg-6 text-right output-text">Compared Value:</p>
            <input class="col-lg-3 vertical-text-padding" type="text" placeholder="Enter value..."></input>
          </div>
        </div>

        <div class="row row-mid-padded text-center">
          <select class="col-centered output-text">
            <option selected disabled hidden>Logical Operator</option>
            <option>AND</option>
            <option>OR</option>
            <option>XOR</option>
            <option>NAND</option>
            <option>NOR</option>
          </select>
        </div>

        <!-- Condition 2 -->
        <div class="col-lg-8 col-centered box">
          <div class="row row-padded label-text text-center">
            <label>Condition 2</label>
            <input class="mediumCheckbox" type="checkbox"></input>
          </div>

          <div class="row row-padded text-center">
            <select class="output-text">
              <option disabled selected hidden>Investigated Field</option>
              <option>Field1</option>
              <option>Field2</option>
              <option>Field3</option>
            </select>
          </div>

          <div class="row row-mid-padded text-center">
            <select class="output-text">
              <option disabled selected hidden>Comparator</option>
              <option> == </option>
              <option> != </option>
              <option> <  </option>
              <option> <= </option>
              <option> >  </option>
              <option> => </option>
            </select>
          </div>

          <div class="row row-mid-padded">
            <p class="col-lg-6 text-right output-text">Compared Value:</p>
            <input class="col-lg-3 vertical-text-padding" type="text" placeholder="Enter value..."></input>
          </div>
        </div>


        <!-- TODO: make submit button actuall submit relevant data -->
        <div class="row row-padded text-center">
          <button class="btn btn-success btn-regular" type="submit">Select</button>
          <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
        </div>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/selectDatasetFunctions.js"></script>
<script>

</script>
</html>
