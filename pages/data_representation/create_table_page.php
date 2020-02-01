<?php
  session_start();
  $title = 'Create Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }


  if(!empty($_POST['submitted'])){
    //proccess submission
    echo 'TODO';
    exit();
  }

  if(!empty($_POST['Dataset_IDs'])){$Dataset_IDs = $_POST['Dataset_IDs'];}
  else{$Dataset_IDs = array(1, 2);}

  if(!empty($_POST['Table_title'])){$Table_title = $_POST['Table_title'];}
  else{$Table_title = '';}

  if(!empty($_POST['Table_description'])){$Table_description = $_POST['Table_description'];}
  else{$Table_description = '';}

  require($current_path . '/templates/navbar.php');
?>
  <form id="tableForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <div class="container box">
      <div class="row row-padded text-center">
        <input id="Table_title" name="Table_title" class="col-lg-8 col-centered output-text" type="text"
        placeholder="Enter table title..." value="<?php echo $Table_title; ?>"/>
      </div>

      <div class="row row-padded text-center">
        <textarea id="Table_description" name="Table_description" class="col-lg-8 col-centered output-text description-box"
        placeholder="Enter table description..."><?php echo $Table_description; ?></textarea>
      </div>

      <div id="columnSelection" class="row row-padded">
      </div>

      <!-- TODO: make submit button actuall submits relevant data -->
      <div class="row row-padded text-center">
        <button class="btn btn-success btn-regular" type="submit" name="submitted" value="true">Save</button>
        <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/createTableFunctions.js"></script>
<script>
  renderColumns(<?php echo '['.implode(', ',$Dataset_IDs).']'; ?>);
</script>
</html>
