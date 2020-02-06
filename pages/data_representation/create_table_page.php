<?php
  session_start();
  if(isset($_POST['_ID'])){
    $title = 'Edit Table';
    $Data_table_ID = $_POST['_ID'];
  }
  else{
    $title = 'Create Table';
  }
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  if(isset($_POST['Title'])){$Title = $_POST['Title'];}
  else{$Title = '';}

  if(isset($_POST['Description'])){$Description = $_POST['Description'];}
  else{$Description = '';}

  if(isset($_POST['Dataset_IDs'])){$Dataset_IDs = $_POST['Dataset_IDs'];}
  else{$Dataset_IDs = array();}

  //Data table submitted
  if(!empty($_POST['submitted'])){
    if(isset($Data_table_ID)){
      //edit table
      $sql = "UPDATE data_table SET Table_title=?, Table_description=? WHERE Data_table_ID=$Data_table_ID";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $Title, $Description);
      $stmt->execute();
      $stmt->close();
      $new_datatable_ID = $Data_table_ID;
    }else{
      //create table
      $sql = "INSERT INTO data_table (Table_title, Table_description) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $Title, $Description);
      $stmt->execute();
      $stmt->close();

      $stmt = $conn->prepare("SELECT LAST_INSERT_ID()");
      $stmt->bind_result($new_datatable_ID);
      $stmt->execute();
      $stmt->fetch();
      $stmt->close();
    }

    $sql = "UPDATE dataset SET Data_table_ID=? WHERE Dataset_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_datatable_ID, $Dataset_ID);
    foreach($Dataset_IDs as $dataset_ID){
      if($dataset_ID != "null"){
        $Dataset_ID = $dataset_ID;
        $stmt->execute();
      }
    }
    $stmt->close();
    $conn->close();
    header("Location: /StudentLogger/pages/data_representation/data_representation_page.php");
  }


  //Dataset submitted
  if(isset($_POST['Dataset_index'])){
    include($current_path . '/php/create_remove_dataset.php');
    $Dataset_index = $_POST['Dataset_index'];
    if(isset($Dataset_IDs[$Dataset_index])){
      $old_dataset_ID = $Dataset_IDs[$Dataset_index];
      remove_dataset($conn, $old_dataset_ID);
    }
    $new_dataset_ID = create_dataset($conn, $_POST);
    $Dataset_IDs[$Dataset_index] = $new_dataset_ID;
  }

  require($current_path . '/templates/navbar.php');
?>
  <form id="tableForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <?php
      if(isset($Data_table_ID)){
        echo "<input name='_ID' value='$Data_table_ID' style='display: none;'/>";
      }
    ?>
    <div class="container box">
      <div class="row row-padded text-center">
        <input id="Title" name="Title" class="col-lg-8 col-centered output-text" type="text"
        placeholder="Enter table title..." value="<?php echo $Title; ?>"/>
      </div>

      <div class="row row-padded text-center">
        <textarea id="Description" name="Description" class="col-lg-8 col-centered output-text description-box"
        placeholder="Enter table description..."><?php echo $Description; ?></textarea>
      </div>

      <div id="columnSelection" class="row row-padded">
      </div>

      <!-- TODO?: validate if any datasets have been entered -->
      <div class="row row-padded text-center">
        <button class="btn btn-success btn-regular" type="submit" name="submitted" value=true >Save</button>
        <button class="btn btn-danger btn-regular" type="button" onclick="cancel()">Cancel</button>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/createTableFunctions.js"></script>
<script>
  var Dataset_IDs = <?php echo '['.implode(', ',$Dataset_IDs).']'; ?>;
  renderColumns(Dataset_IDs);
</script>
</html>
