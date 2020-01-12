<?php
  session_start();
  $title = 'Select Dataset';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>

  <form action="" method="post">
    <div class="container box">
      <div class="row row-padded text-center">
        <select class="col-centered output-text">
          <option disabled selected hidden>Select Table</option>
          <option>Table1</option>
          <option>Table2</option>
          <option>Table3</option>
        </select>
      </div>

      <div class="row row-padded text-center">
        <select class="col-centered output-text">
          <option disabled selected hidden>Select Output Field</option>
          <option>Field1</option>
          <option>Field2</option>
          <option>Field3</option>
        </select>
      </div>

      <div class="row row-padded text-center">
        <select class="output-text">
          <option disabled selected hidden>Order Determining Field</option>
          <option>Field1</option>
          <option>Field2</option>
          <option>Field3</option>
        </select>
        <select class="output-text">
          <option disabled selected hidden>Order</option>
          <option>Ascending</option>
          <option>Descending</option>
        </select>
      </div>

      <!-- First condition box -->
      <!-- TODO: implement dynamic adding of more condition boxes -->
      <div class="row row-padded">
        <div class="col-lg-8 col-centered box">
          <div class="row row-padded label-text text-center">
            <label>Condition 1</label>
            <input class="mediumCheckbox" type="checkbox"></input>
          </div>

          <div class="row row-padded text-center">
            <select class="output-text">
              <option disabled selected hidden>Investigated Field</option>
              <option>Field1</option>
              <option>Field2</option>
              <option>Field3</option>
            </select>
          </div>

          <!-- with adequete comparators, the "not" option isn't necessary -->

          <div class="row row-mid-padded text-center">
            <select class="output-text">
              <option disabled selected hidden>Comparator</option>
              <option> == </option>
              <option> != </option>
              <option> <  </option>
              <option> <= </option>
              <option> >  </option>
              <option> => </option>
            </select>
          </div>

          <div class="row row-mid-padded">
            <p class="col-lg-6 text-right output-text">Compared Value:</p>
            <input class="col-lg-3 vertical-text-padding" type="text" placeholder="Enter value..."></input>
          </div>
        </div>

        <!-- TODO: make submit button actuall submit relevant data -->
        <div class="row row-padded text-center">
          <button class="btn btn-success btn-regular" type="submit">Select</button>
          <a class="btn btn-danger btn-regular" href="data_representation_page.php">Cancel</a>
        </div>
      </div>

      <div id="buffer-box-small"></div>
    </div>
  </form>

  <div id="buffer-box"></div>
</body>
</html>
