<?php
  session_start();
  $title = 'Admin Settings';
  $web_section = 'account';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');

  $container = true;
  $label = 'Select User';
  $id_querybox = 'qBox1';
  $id_searchbar = 'sbar1';
  $id_searchbutton = 'sbut1';
  $id_selection = 'select1';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = array('User1', 'User2', 'User3');
  $buttons = '';
  require($current_path . '/templates/query_box_template.php');
?>

<div id="buffer-box"></div>

<!-- TODO: Hide with javascript if no user selected -->
<div class="rounded-box container tb-padding">
  <div class="label-text row text-center">
    <!-- return actual selected user -->
    [Selected User]
  </div>

  <div class="row row-padded">
    <div class="label-text col-lg-2 text-right">Classes:</div>
    <div class="scrollbox box col-lg-9">
      <!-- TODO: return actual classes from database -->
      13ENG, 12ENG, 13ECO
    </div>
  </div>

  <!-- TODO: sumbit privilege update and delete users -->
  <form action="" method="post">
    <div class="row tb-padding">
      <div class="label-text col-lg-3 text-right">Privilege:</div>
      <input type="number" name="privilege" step="1" min="0" max="2" value="2" class="vertical-text-padding col-lg-1">
      <div class="col-lg-1"></div>
      <button class="col-lg-2 btn btn-success" type="submit">Update Privilege</button>
      <div class="col-lg-1"></div>
      <button class="col-lg-2 btn btn-danger" type="button">Remove User</button>
    </div>
  </form>

  <?php
    $container = false;
    $label = 'Select Class';
    $id_querybox = 'qBox2';
    $id_searchbar = 'sbar2';
    $id_searchbutton = 'sbut2';
    $id_selection = 'select2';
    $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
    $options = array('13ENG', '12ENG', '13ECO');
    $buttons = '
    <div class="btn-toolbar row row-padded">
      <div class="col-lg-4"></div>
      <button class="col-lg-2 btn btn-success" type="button">Assign User to Class</button>
      <button class="col-lg-2 btn btn-warning" type="button">Unassign User from Class</button>
    </div>
    ';
    require($current_path . '/templates/query_box_template.php');
  ?>

</div>

<div id="buffer-box"></div>
</body>
</html>
