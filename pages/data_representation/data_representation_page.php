<?php
  session_start();
  $title = 'Data Representation Page';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  require($current_path . '/templates/navbar.php');
?>

  <!-- [INSERT BODY HERE] -->

  <div id="buffer-box"></div>
</body>
</html>
