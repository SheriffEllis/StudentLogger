<?php
  session_start();
  $title = 'Select Dataset';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  //TODO: adjust for function
  $Title = $_POST['Title'];
  $Description = $_POST['Description'];
  $Dataset_IDs = $_POST['Dataset_IDs'];
  $Dataset_index = $_POST['Dataset_index'];
  $Postback = $_POST['Postback'];
  $javascript_data = "'".$Title."', '".$Description.
    "', [".implode(', ', $Dataset_IDs)."], ".$Dataset_index;

  require($current_path . '/templates/navbar.php');
?>

  <form id="datasetForm" action="<?php echo $Postback; ?>" method="post">
    <div class="container box">
      <div class="row row-padded text-center output-text">
        <input id="datasetName" name="dataset_name" type="text" placeholder="Enter dataset name..."/>
      </div>

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
        <select id="outputFieldSelect" name="output_field" class="col-centered output-text" >
        </select>
      </div>

      <div id="orderDeterminingRow" class="row row-padded text-center" style="display: none;">
        <select id="orderDeterminingFieldSelect" name="order_field" class="output-text">
        </select>
        <select id="orderSelect" name="order" class="output-text">
          <option disabled selected hidden>Order</option>
          <option value="ASC">Ascending</option>
          <option value="DESC">Descending</option>
        </select>
      </div>

      <div class="row row-padded">
        <div id="conditionsSection">
        </div>

        <div class="row row-padded text-center">
          <button class="btn btn-success btn-regular" type="button" onclick="selectDataset(<?php echo $javascript_data; ?>)">Select</button>
          <button class="btn btn-danger btn-regular" type="button" onclick="cancelDataset(<?php echo $javascript_data; ?>)">Cancel</button>
        </div>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/selectDatasetFunctions.js"></script>
</html>
