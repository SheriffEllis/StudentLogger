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
          <option value="ascending">Ascending</option>
          <option value="descending">Descending</option>
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
<script>
  function selectDataset(Title, Description, Dataset_IDs, Dataset_index){
    var form = $('#datasetForm');
    if(validateInput()){
      appendResubmissionData(form, Title, Description, Dataset_IDs);
      alert(`<input style="display: none;" name="Dataset_index" value=${Dataset_index} />`);
      form.append(`<input style="display: none;" name="Dataset_index" value=${Dataset_index} />`);
      form.submit();
    }
  }

  function cancelDataset(Title, Description, Dataset_IDs){
    var form = $('#datasetForm');
    form.empty();
    appendResubmissionData(form, Title, Description, Dataset_IDs);
    form.submit();
  }

  function appendResubmissionData(form, Title, Description, Dataset_IDs){
    var Dataset_IDs_String = '';
    $.each(Dataset_IDs, function(index, value){
      if(value != null){
        Dataset_IDs_String = Dataset_IDs_String.concat(`
          <input name="Dataset_IDs[${index}]" value=${value} />
        `);
      }
    });
    form.append(`
      <div style="display: none;">
        <input name="Title" value="${Title}"/>
        <input name="Description" value="${Description}" />
        ${Dataset_IDs_String}
      </div>
    `);
  }

  function validateInput(){
    var tableSelection = $('#tableSelect').val();
    var outputFieldSelection = $('#outputFieldSelect').val();
    var orderDeterminingFieldSelection = $('#orderDeterminingFieldSelect').val();
    var orderSelection = $('#orderSelect').val();

    if(tableSelection && outputFieldSelection && orderDeterminingFieldSelection && orderSelection){
      return true;
    }

    if(!tableSelection){
      alert('Please select a table');
    }else if(!outputFieldSelection){
      alert('Please select an output field');
    }else if(!orderDeterminingFieldSelection){
      alert('Please select an order determining field');
    }else if(!orderSelection){
      alert('Please select an order of output');
    }
    return false;
  }
</script>
</html>
