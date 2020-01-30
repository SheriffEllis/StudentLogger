<?php
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Function_ID = $_POST['Function_ID'];

  $stmt = $conn->prepare('SELECT Function_description, Function_type FROM function WHERE Function_ID=? LIMIT 1');
  $stmt->bind_param('i', $Function_ID);
  $stmt->execute();
  $stmt->bind_result($description, $functionTypeID);
  $stmt->fetch();
  $stmt->close();

  $current_path = getenv('CURRENT_PATH');
  require($current_path . '/php/custom_function.php');
  $functionType = customFunction($functionTypeID);

  $stmt = $conn->prepare('SELECT Value_name FROM dataset WHERE Function_ID=?');
  $stmt->bind_param('i', $Function_ID);
  $stmt->execute();
  $stmt->bind_result($input);
  $inputs = array();
  while($stmt->fetch()){
    array_push($inputs, $input);
  }
  $inputs_string = implode(', ', $inputs);

  $conn->close();

  echo json_encode(array('description'=>$description, 'inputs'=>$inputs_string, 'functionType'=>$functionType));
?>
