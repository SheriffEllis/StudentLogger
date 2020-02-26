<?php
  session_start();
  if(isset($_POST['_ID'])){
    $title = 'Edit Function';
    $Function_ID = $_POST['_ID'];
  }
  else{
    $title = 'Create Function';
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

  if(isset($_POST['Function_type'])){$Function_type = $_POST['Function_type'];}
  else{$Function_type = null;}

  if(isset($_POST['Dataset_IDs'])){$Dataset_IDs = $_POST['Dataset_IDs'];}
  else{$Dataset_IDs = array();}

  //function submitted
  if(!empty($_POST['submitted'])){
    if(isset($Function_ID)){
      //edit function
      $sql = "UPDATE function SET Function_title=?, Function_description=?, Function_type=? WHERE Function_ID=$Function_ID";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssi", $Title, $Description, $Function_type);
      $stmt->execute();
      $stmt->close();
      $new_function_ID = $Function_ID;
    }else{
      //create function
      $sql = "INSERT INTO function (Function_title, Function_description, Function_type) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssi", $Title, $Description, $Function_type);
      $stmt->execute();
      $stmt->close();

      $stmt = $conn->prepare("SELECT LAST_INSERT_ID()");
      $stmt->bind_result($new_function_ID);
      $stmt->execute();
      $stmt->fetch();
      $stmt->close();
    }

    //Assign each dataset to the new created function
    $sql = "UPDATE dataset SET Function_ID=? WHERE Dataset_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_function_ID, $Dataset_ID);
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
  <form id="functionForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <?php
      if(isset($Function_ID)){
        echo "<input name='_ID' value='$Function_ID' style='display: none;'/>";
      }
    ?>
    <div class="container box">
      <div class="row row-padded text-center">
        <input id="Title" name="Title" class="col-lg-8 col-centered output-text" type="text"
        placeholder="Enter function title..." value="<?php echo $Title; ?>"/>
      </div>

      <div class="row row-padded text-center">
        <textarea id="Description" name="Description" class="col-lg-8 col-centered output-text description-box"
        placeholder="Enter function description..."><?php echo $Description; ?></textarea>
      </div>

      <div class="row row-padded text-center">
          <select id="Function_type" name="Function_type" class="output-text">
            <option disabled <?php if(!isset($Function_type)){echo 'selected';} ?> hidden>Select Function</option>
            <?php
              //List all the available custom functions to use
              include($current_path . "/php/custom_function.php");
              for($i=0; customFunction($i) != null; $i++){
                $functionName = customFunction($i);
                if($i == $Function_type){
                  $selected = 'selected';
                }else{
                  $selected = '';
                }
                echo "<option $selected value=$i >$functionName</option>";
              }
            ?>
          </select>
      </div>

      <div id="valueSelection" class="row row-padded">
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
<script src="/StudentLogger/js/createFunctionFunctions.js"></script>
<script>
  var Dataset_IDs = <?php echo '['.implode(', ',$Dataset_IDs).']'; ?>;
  renderValues(Dataset_IDs);
</script>
</html>
