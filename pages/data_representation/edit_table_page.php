<?php
  session_start();
  $title = 'Edit Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>
  <!-- TODO: input already existing table data for the edit page -->
  <form action="" method="post">
    <div class="container box">
      <div class="row row-padded text-center">
        <input name="table_title" class="col-lg-8 col-centered output-text" type="text" placeholder="Enter table title..."></input>
      </div>

      <div class="row row-padded text-center">
        <textarea name="table_description" class="col-lg-8 col-centered output-text description-box" placeholder="Enter table description..."></textarea>
      </div>

      <!-- TODO: make into dyanmic column selection as well as output datasets -->
      <div class="row row-padded">
        <div class="row row-padded">
          <label class="label-text text-right col-lg-6">Column 1:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
        <div class="row row-padded">
          <label class="label-text text-right col-lg-6">Column 2:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
        <div class="row row-padded">
          <label class="label-text text-right col-lg-6">Column 3:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
      </div>

      <!-- TODO: make submit button actuall submit relevant data -->
      <div class="row row-padded text-center">
        <button class="btn btn-success btn-regular" type="submit">Save</button>
        <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
</html>
