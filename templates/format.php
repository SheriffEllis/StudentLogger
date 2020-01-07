<?php
  session_start();
  $title = '';
  $web_section = '';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . "/templates/navbar.php");
?>

  <!-- [INSERT BODY HERE] -->

<div id="buffer-box"></div>
</body>
</html>
