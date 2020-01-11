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
          //TODO: substitute real table names
          $label = 'Select Table';
          $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
          $options = array('Table Name 1', 'Table Name 2', 'Table Name 3');
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
        <!-- TODO: input actual descriptions and datasets -->
        <label class="description-text bold">Description:</label>
        <p id="table-description" class="description-text">(Description)</p>

        <label class="description-text bold">Table Columns:</label>
        <p id="table-columns" class="description-text">DataSet1, DataSet2, DataSet3</p>

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
          //TODO: substitute real function names
          $label = 'Select Function';
          $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
          $options = array('Function Name 1', 'Function Name 2', 'Function Name 3');
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
        <!-- TODO: input actual descriptions, inputs, and function type -->
        <label class="description-text bold">Description:</label>
        <p id="function-description" class="description-text">(Description)</p>

        <label class="description-text bold">Function Inputs:</label>
        <p id="function-inputs" class="description-text">DataSet1, DataSet2, DataSet3</p>

        <label class="description-text bold">Function Type:</label>
        <p id="function-type" class="description-text">AVERAGE(Value1, Value2, ...)</p>

        <div class="row row-padded text-center">
          <a class="btn-regular btn btn-primary text-center" href="">View Function Output</a>
        </div>
      </div>
    </div>
  </div>

  <div id="buffer-box"></div>
</body>
</html>
