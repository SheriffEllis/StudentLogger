<?php
  session_start();
  $title = 'View Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>

  <div class="container">
    <div class="row text-center">
      <a class="btn btn-primary btn-regular col-centered" href="data_representation.php">Back</a>
    </div>

    <!-- TODO: insert table name -->
    <div class="row row-padded text-center">
      <label class="label-text">[Table Name]</label>
    </div>

    <!-- TODO: insert description -->
    <div class="row row-padded ">
      <p class="tb-padding box col-lg-6 col-centered output-text">
        (Description)
      </p>
    </div>

    <div id="buffer-box"></div>

    <!-- TODO: enter actual table values -->
    <table class="col-centered">
      <tr>
        <th>Column1</th>
        <th>Column2</th>
        <th>Column3</th>
        <th>Column4</th>
      </tr>
      <tr>
        <td>value1</td>
        <td>value2</td>
        <td>value3</td>
        <td>value4</td>
      </tr>
      <tr>
        <td>value1</td>
        <td>value2</td>
        <td>value3</td>
        <td>value4</td>
      </tr>
      <tr>
        <td>value1</td>
        <td>value2</td>
        <td>value3</td>
        <td>value4</td>
      </tr>
    </table>

  </div>

  <div id="buffer-box"></div>
</body>
</html>
