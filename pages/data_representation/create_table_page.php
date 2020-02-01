<?php
  session_start();
  $title = 'Create Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  //unset($_POST['Dataset_IDs']);
  if(!empty($_POST['Dataset_IDs'])){$Dataset_IDs = $_POST['Dataset_IDs'];}
  else{$Dataset_IDs = array(1, 2);}

  if(!empty($_POST['Table_title'])){$Table_title = $_POST['Table_title'];}
  else{$Table_title = '';}

  if(!empty($_POST['Table_description'])){$Table_description = $_POST['Table_description'];}
  else{$Table_description = '';}

  require($current_path . '/templates/navbar.php');
?>
  <form id="tableForm" action="" method="post">
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
        <button class="btn btn-success btn-regular" type="submit">Save</button>
        <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
<script>
  renderColumns(<?php echo '['.implode(', ',$Dataset_IDs).']'; ?>);

  function renderColumns(Dataset_IDs){
    $('#columnSelection').empty();
    if(Dataset_IDs.length > 0){
      //search for Dataset_names corresponding to IDs
      $.post('/StudentLogger/php/retrieve_dataset_names.php', {Dataset_IDs: Dataset_IDs},
      function(Dataset_names){
        $.each(Dataset_IDs, function(index, value){
          addColumn(Dataset_IDs, index, Dataset_names[value], value);
        });
        //Final column to select new dataset
        addColumn(Dataset_IDs, Dataset_IDs.length);
      }, 'json');
    }else{
      //If dataset_ID list is empty, only display first empty column
      addColumn(Dataset_IDs, Dataset_IDs.length);
    }
  }

  function addColumn(Dataset_IDs, index, Dataset_name = '(Select Data Set)', Dataset_ID = null){
    var buttonClass;
    if(Dataset_name == '(Select Data Set)'){
      buttonClass = 'btn-default';
    }else{
      buttonClass = 'btn-primary';
    }
    var Dataset_IDs_string = `[${Dataset_IDs.toString()}]`;

    $('#columnSelection').append(`
      <div class="row row-padded">
        <input name="Dataset_IDs[${index}]" style="display: none;" value="${Dataset_ID}"/>
        <label class="label-text text-right col-lg-6">Column ${index}:</label>
        <button class="btn btn-regular ${buttonClass}" type="button" onclick="selectDataset(${Dataset_IDs_string}, ${index})">${Dataset_name}</button>
      </div>
    `);
  }

  function selectDataset(Dataset_IDs, index){
    var url = '/StudentLogger/pages/data_representation/select_dataset_page.php';
    var form = $('#tableForm');
    form.append(`
      <input name="Dataset_index" value="${index}"/>
    `);
    form.attr('action', url); //change action of form to submit (temporily) to select dataset page
    form.submit();
  }
</script>
</html>
