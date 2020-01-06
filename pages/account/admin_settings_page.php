<?php
  session_start();
  $title = 'Admin Settings';
  $web_section = 'account';

  require(getenv('REQUIRE_PATH'));
?>

<div class="container text-center" style="padding-bottom: 40px;">
  <!-- TODO create script for retrieving search results -->
  <label for="search" id="label-text">Select User</label>
  <form action="admin_settings_page.php" method="post">
    <input name="search" id="searchbar" placeholder="Search..." type="text"></input>
    <button id="searchbutton" type="submit"><span class="glyphicon glyphicon-search"></span></button>
  </form>

  <!-- TODO: Use javascript to allow multiple buttons to use same selection? -->
  <select id="scrollbox" size=10 class="col-lg-7 col-centered">
    <!-- TODO: Enter search results into these options -->
    <option>User1</option>
    <option>User2</option>
    <option>User3</option>
  </select>
</div>

<!-- TODO: Hide with javascript if no user selected -->
<div class="rounded-box container tb-padding">
  <div id="label-text" class="row text-center">
    <!-- return actual selected user -->
    [Selected User]
  </div>

  <div class="row row-padded">
    <div id="label-text" class="col-lg-2 text-right">Classes:</div>
    <div id="scrollbox" class="box col-lg-9">
      <!-- TODO: return actual classes from database -->
      13ENG, 12ENG, 13ECO
    </div>
  </div>

  <form action="" method="post">
    <div class="row tb-padding">
      <div id="label-text" class="col-lg-3 text-right">Privilege:</div>
      <input type="number" name="privilege" step="1" min="0" max="2" value="2" class="vertical-text-padding col-lg-1">
      <div class="col-lg-1"></div>
      <button class="col-lg-2 btn btn-success" type="submit">Update Privilege</button>
      <div class="col-lg-1"></div>
      <button class="col-lg-2 btn btn-danger" type="button">Remove User</button>
    </div>
  </form>

  <!-- TODO create script for retrieving search results -->
  <div class="text-center">
    <label for="search" id="label-text">Select Class</label>
    <form action="admin_settings_page.php" method="post">
      <input name="search" id="searchbar" placeholder="Search..." type="text"></input>
      <button id="searchbutton" type="submit"><span class="glyphicon glyphicon-search"></span></button>
    </form>

    <!-- TODO: Use javascript to allow multiple buttons to use same selection? -->
    <select id="scrollbox" size=10 class="col-lg-7 col-centered">
      <!-- TODO: Enter search results into these options -->
      <option>13ENG</option>
      <option>12ENG</option>
      <option>13ECO</option>
    </select>
  </div>

  <div class="btn-toolbar row row-padded">
    <div class="col-lg-4"></div>
    <button class="col-lg-2 btn btn-success" type="button">Assign User to Class</button>
    <button class="col-lg-2 btn btn-warning" type="button">Unassign User from Class</button>
  </div>
</div>

<div id="buffer-box"></div>
</body>
</html>
