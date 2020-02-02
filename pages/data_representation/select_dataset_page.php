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
    Submit->create dataset->add dataset id to Dataset_IDs->Submit data
    Cancel->Resubmit data
    if user cancels creation of table, all prior created datasets should be deleted
  */
?>

  <form action="<?php echo $Postback; ?>" method="post">
    <!-- hidden part of form resubmitting data to datatable/function -->
    <div style="display: none;">
      <?php
        if($Postback == 'create_table_page.php'){
          echo '
            <input name="Table_title" value="'.$Table_title.'"/>
            <input name="Table_description" value="'.$Table_description.'"/>
            <input name="Dataset_index" value="'.$Dataset_index.'"/>
          ';
          foreach($Dataset_IDs as $index=>$ID){
            echo '<input name="Dataset_IDs['.$index.']" value="'.$ID.'"/>';
          }
        }else{
          //TODO
        }
      ?>
    </div>

    <div class="container box">
      <div class="row row-padded text-center">
        <select id="tableSelect" name="selected_table" onchange="renderOptions()" class="col-centered output-text">
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
        <select id="outputFieldSelect" name="output_field" class="col-centered output-text">
        </select>
      </div>

      <div id="orderDeterminingRow" class="row row-padded text-center" style="display: none;">
        <select id="orderDeterminingFieldSelect" name="order_field" class="output-text">
        </select>
        <select name="ascending" class="output-text">
          <option disabled selected hidden>Order</option>
          <option value=true>Ascending</option>
          <option value=false>Descending</option>
        </select>
      </div>

      <div class="row row-padded">
        <div id="conditionsSection">
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
