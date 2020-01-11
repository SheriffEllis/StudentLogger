<?php
  session_start();
  $title = 'View Function Output';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>
<div class="container">
  <div class="row text-center">
    <a class="btn btn-primary btn-regular col-centered" href="data_representation_page.php">Back</a>
  </div>

  <div id="buffer-box"></div>

  <!-- TODO: insert function name -->
  <div class="row row-padded text-center">
    <label class="label-text">[Function Name]</label>
  </div>

  <!-- TODO: insert description -->
  <div class="row row-padded">
    <p class="tb-padding box col-lg-6 col-centered output-text">
      (Description)
    </p>
  </div>

  <div id="buffer-box"></div>

  <div class="row row-padded text-center">
    <p class="output-text">AVERAGE(Value1, Value2, ...)</p>
  </div>
  <!-- TODO: enter actual function values and output -->
  <table class="col-centered">
    <tr>
      <th>Value1</th>
      <th>Value2</th>
      <th>Value3</th>
      <th>Output</th>
    </tr>
    <tr>
      <td>value1</td>
      <td>value2</td>
      <td>value3</td>
      <td>output</td>
    </tr>
    <tr>
      <td>value1</td>
      <td>value2</td>
      <td>value3</td>
      <td>output</td>
    </tr>
    <tr>
      <td>value1</td>
      <td>value2</td>
      <td>value3</td>
      <td>output</td>
    </tr>
  </table>

</div>

<div id="buffer-box"></div>
</body>
</html>
