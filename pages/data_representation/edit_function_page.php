<?php
  session_start();
  $title = 'Edit Function';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>
  <form action="" method="post">
    <div class="container box">
      <div class="row row-padded text-center">
        <input name="function_title" class="col-lg-8 col-centered output-text" type="text" placeholder="Enter function title..."></input>
      </div>

      <div class="row row-padded text-center">
        <textarea name="function-description" class="col-lg-8 col-centered output-text description-box" placeholder="Enter function description..."></textarea>
      </div>

      <!-- TODO: input actual functions into options -->
      <div class="row row-padded text-center">
        <div class="row">
          <select class="output-text">
            <option disabled selected hidden>Select Function</option>
            <option>Function 1</option>
            <option>Function 2</option>
            <option>Function 3</option>
          </select>
        </div>
        <div class="row row-padded">
          <p class="output-text">AVERAGE(Value1, Value2, ...)</p>
        </div>
      </div>

      <!-- TODO: make into dyanmic column selection as well as output datasets -->
      <div class="row row-padded">
        <div class="row row-padded">
          <label class="label-text text-right col-lg-6">Value 1:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
        <div class="row row-padded">
          <label class="label-text text-right col-lg-6">Value 2:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
        <div class="row row-padded">
          <label class="label-text text-right col-lg-6">Value 3:</label>
          <a class="btn btn-regular btn-default" href="select_dataset_page.php">(Select Data Set)</a>
        </div>
      </div>

      <!-- TODO: make submit button actuall submit relevant data -->
      <div class="row row-padded text-center">
        <button class="btn btn-success btn-regular" type="submit">Save</button>
        <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
      </div>

      <div id="buffer-box"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
</html>
