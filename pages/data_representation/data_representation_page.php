<?php
  session_start();
  $title = 'Data Representation Page';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>

  <div class="container">
    <!-- TABLES SECTION -->
    <div class="row row-padded text-center">
      <label class="label-text">Tables</label>
    </div>
    <div class="row row-padded">
      <div class="col-lg-8">
        <?php
          //Table Query Box
          $label = 'Select Table';
          $id_searchbar = 'tableSearchbar';
          $id_selection = 'tableSelect';
          $search_script = "searchNormal('#$id_searchbar','#$id_selection','data_table','Data_table_ID','Table_title')";
          $select_script = 'selectTable()';
          $buttons = '
          <div class="text-center">
            <a class="btn-regular btn btn-success" href="create_table_page.php">Add Table</a>
            <a class="btn-regular btn btn-warning" href="edit_table_page.php">Edit Table</a>
            <a class="btn-regular btn btn-danger" href="">Remove Table</a>
          </div>
          ';
          require($current_path . '/templates/query_box_template.php');
        ?>
      </div>
      <div class="col-lg-4 description-box box">
        <label class="description-text bold">Description:</label>
        <p id="table-description" class="description-text">...</p>

        <label class="description-text bold">Table Columns:</label>
        <p id="table-columns" class="description-text">...</p>

        <div class="row row-padded text-center">
          <a class="btn-regular btn btn-primary text-center" href="view_table_page.php">View Table</a>
        </div>
      </div>
    </div>

    <div id="buffer-box"></div>

    <!-- FUNCTIONS SECTION -->
    <div class="row row-padded text-center">
      <label class="label-text">Functions</label>
    </div>
    <div class="row row-padded">
      <div class="col-lg-8">
        <?php
          //Function Query Box
          $label = 'Select Function';
          $id_searchbar = 'functionSearchbar';
          $id_selection = 'functionSelect';
          $search_script = "searchNormal('#$id_searchbar','#$id_selection','function','Function_ID','Function_title')";
          $select_script = 'selectFunction()';
          $buttons = '
          <div class="text-center">
            <a class="btn-regular btn btn-success" href="create_function_page.php">Add Function</a>
            <a class="btn-regular btn btn-warning" href="edit_function_page.php">Edit Function</a>
            <a class="btn-regular btn btn-danger" href="">Remove Function</a>
          </div>
          ';
          require($current_path . '/templates/query_box_template.php');
        ?>
      </div>
      <div class="col-lg-4 description-box box">
        <label class="description-text bold">Description:</label>
        <p id="function-description" class="description-text">...</p>

        <label class="description-text bold">Function Inputs:</label>
        <p id="function-inputs" class="description-text">...</p>

        <label class="description-text bold">Function Type:</label>
        <p id="function-type" class="description-text">...</p>

        <div class="row row-padded text-center">
          <a class="btn-regular btn btn-primary text-center" href="view_function_page.php">View Function Output</a>
        </div>
      </div>
    </div>
  </div>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/searchFunctions.js"></script>
<script>
  function selectTable(){
    var tableId = $('#tableSelect').val();
    if(tableId){
      $.post('/StudentLogger/php/retrieve_table_properties.php', {Data_table_ID : tableId},
        function(results){
          var description = results.description;
          var columns = results.columns;

          $('#table-description').text(description);
          $('#table-columns').text(columns);
        }
      , 'json');
    }
  }

  function selectFunction(){
    var functionId = $('#functionSelect').val();
    if(functionId){
      $.post('/StudentLogger/php/retrieve_function_properties.php', {Function_ID : functionId},
        function(results){
          var description = results.description;
          var inputs = results.inputs;
          var functionType = results.functionType;

          $('#function-description').text(description);
          $('#function-inputs').text(inputs);
          $('#function-type').text(functionType);
        }
      , 'json');
    }
  }

  searchNormal('#tableSearchbar','#tableSelect','data_table','Data_table_ID','Table_title');
  searchNormal('#functionSearchbar','#functionSelect','function','Function_ID','Function_title');
</script>
</html>
