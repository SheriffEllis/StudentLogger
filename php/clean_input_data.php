<?php
function clean_input_data($data, $do_lowercase = true){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  if($do_lowercase){
    $data = strtolower($data);
  }
  return $data;
}
?>
