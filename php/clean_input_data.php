<?php
function cleaninputdata($data, $do_lowercase = true){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  if($do_lowercase){
    $data = strtolower($data);
  }
  return $data;
}
?>
