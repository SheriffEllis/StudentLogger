<?php
  session_start();
  $title = 'Manage Students Page';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');

  $container = true;
  $label = 'Select Student';
  $id_querybox = 'qBox1';
  $id_searchbar = 'sbar1';
  $id_searchbutton = 'sbut1';
  $id_selection = 'select1';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('Student1', 'Student2', 'Student3');
  $buttons = '
  <div class="btn-toolbar row row-padded">
    <div class="col-lg-4"></div>
    <button class="col-lg-2 btn btn-success" type="button">Button1</button>
    <button class="col-lg-2 btn btn-warning" type="button">Button2</button>
  </div>
  ';
  require($current_path . '/templates/query_box_template.php');
?>

  <!-- [INSERT BODY HERE] -->

<div id="buffer-box"></div>
</body>
</html>
