<?php
  session_start();
  //Check if user is an admin just in case by checking their privilege
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $usr = $_SESSION['usr'];

  $stmt = $conn->prepare('SELECT Privilege FROM teacher WHERE Username=? LIMIT 1');
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($privilege);
  $stmt->fetch();
  $stmt->close();
  //If user was not an admin, send them back to homepage
  if($privilege > 0){header("Location: /StudentLogger/pages/homepage.php");}

  $title = 'Admin Settings';
  $web_section = 'account';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');

  $sql = 'SELECT Username FROM teacher';
  $results = $conn->query($sql);
  $usernames = array();
  while($username = $results->fetch_row()){
    array_push($usernames, $username[0]);
  }

  $is_container = true;
  $label = 'Select User';
  $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
  $options = $usernames;
  $buttons = '';
  $id_selection = 'userSelect';
  $select_script = 'renderUserEdit()';
  require($current_path . '/templates/query_box_template.php');
  unset($id_selection);

  $conn->close();
?>

  <div id="buffer-box"></div>

  <div id="userEdit" class="rounded-box container tb-padding">
    <div id="selectedUserLabel" class="label-text row text-center">
      <!-- Message displayed if javascript does not replace text -->
      [Error: no user selected]
    </div>

    <div class="row row-padded">
      <div class="label-text col-lg-3 text-right">Classes:</div>
      <div id="classesBox" style="height: 100px;" class="scrollbox box col-lg-9">
        <!-- Message displayed if javascript does not replace text -->
        [Error: no classes found]
      </div>
    </div>

    <!-- TODO: sumbit privilege update and delete users -->
    <form action="" method="post">
      <div class="row tb-padding">
        <div class="label-text col-lg-4 text-right">Privilege:</div>
        <input id="privilege" type="number" name="privilege" step="1" min="0" max="2" value="2" class="vertical-text-padding col-lg-1"></input>
        <div class="col-lg-1"></div>
        <button class="btn btn-success btn-regular" type="submit">Update Privilege</button>
        <button class="btn btn-danger btn-regular" type="button">Remove User</button>
      </div>
    </form>

    <?php
      $is_container = false;
      $label = 'Select Class';
      $script_page = htmlspecialchars($_SERVER['PHP_SELF']);
      //TODO: query classes
      $options = array('13ENG', '12ENG', '13ECO');
      $buttons = '
      <div class="row row-padded text-center">
          <button class="btn btn-success btn-regular" type="button">Assign User to Class</button>
          <button class="btn btn-warning btn-regular" type="button">Unassign User from Class</button>
      </div>
      ';
      require($current_path . '/templates/query_box_template.php');
    ?>

  </div>

  <div id="buffer-box"></div>
</body>
<script src="/StudentLogger/js/renderUserEdit.js"></script>
<script>
  //run once on page load
  renderUserEdit();
</script>
</html>
