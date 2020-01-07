<?php
  session_start();
  $title = 'Manage Students Page';
  $web_section = 'manage_students';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . "/templates/navbar.php");
?>

  <!-- [INSERT BODY HERE] -->

<div id="buffer-box"></div>
</body>
</html>
