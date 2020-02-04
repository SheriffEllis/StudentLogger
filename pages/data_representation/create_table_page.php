<?php
  session_start();
  $title = 'Create Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  //Data table submitted
  if(!empty($_POST['submitted'])){
    //create table
    //delete all discarded (unassigned) datasets
  }

  //Dataset submitted
  if(isset($_POST['Dataset_index'])){
    $Dataset_index = $_POST['Dataset_index'];
    //create dataset
  }

  if(!empty($_POST['Dataset_IDs'])){$Dataset_IDs = $_POST['Dataset_IDs'];}
  else{$Dataset_IDs = array(1, 2);}

  if(!empty($_POST['Title'])){$Title = $_POST['Title'];}
  else{$Title = '';}

  if(!empty($_POST['Description'])){$Description = $_POST['Description'];}
  else{$Description = '';}

  require($current_path . '/templates/navbar.php');
?>
  <form id="tableForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
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

      <!-- TODO: make submit button actually submit relevant data -->
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
