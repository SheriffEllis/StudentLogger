<?php
  session_start();
  $title = 'Create Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  if(!empty($_POST['Dataset_IDs'])){$Dataset_IDs = $_POST['Dataset_IDs'];}
  else{$Dataset_IDs = array();}

  if(!empty($_POST['Table_title'])){$Table_title = $_POST['Table_title'];}
  else{$Table_title = '';}

  if(!empty($_POST['Table_description'])){$Table_description = $_POST['Table_description'];}
  else{$Table_description = '';}

  require($current_path . '/templates/navbar.php');
?>
  <form action="" method="post">
    <div class="container box">
      <div class="row row-padded text-center">
        <input name="Table_title" class="col-lg-8 col-centered output-text" type="text"
        placeholder="Enter table title..." value="<?php echo $Table_title; ?>"/>
      </div>

      <div class="row row-padded text-center">
        <textarea name="Table_description" class="col-lg-8 col-centered output-text description-box"
        placeholder="Enter table description..."><?php echo $Table_description; ?></textarea>
      </div>

      <!-- TODO: make into dyanmic column selection as well as output datasets -->
      <div id="columnSelection" class="row row-padded">
        <div class="row row-padded">
          <input name="Dataset_IDs[(index)]" style="display: none;" type="number" value="(value)"/>
          <label class="label-text text-right col-lg-6">Column 1:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
      </div>

      <!-- TODO: make submit button actuall submits relevant data -->
      <div class="row row-padded text-center">
        <button class="btn btn-success btn-regular" type="submit">Save</button>
        <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
<script>
  function renderColumns(){

  }

  function selectDataset(){
    
  }
</script>
</html>
