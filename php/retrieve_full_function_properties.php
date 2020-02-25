<?php
  $conn = new mysqli(getenv("HTTP_HOST"), getenv("HTTP_USER"), getenv("HTTP_PASS"), getenv("HTTP_DATABASE"));
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $Function_ID = $_POST["Function_ID"];

  $stmt = $conn->prepare("SELECT Function_title, Function_description, Function_type FROM function WHERE Function_ID=? LIMIT 1");
  $stmt->bind_param("i", $Function_ID);
  $stmt->execute();
  $stmt->bind_result($Title, $Description, $Function_type);
  $stmt->fetch();
  $stmt->close();

  $stmt = $conn->prepare("SELECT Dataset_ID FROM dataset WHERE Function_ID=? ORDER BY Value_number ASC");
  $stmt->bind_param("i", $Function_ID);
  $stmt->execute();
  $stmt->bind_result($Dataset_ID);
  $Dataset_IDs = array();
  while($stmt->fetch()){
    array_push($Dataset_IDs, $Dataset_ID);
  }

  $conn->close();

  echo json_encode(array("Title"=>$Title, "Description"=>$Description, "Function_type"=>$Function_type, "Dataset_IDs"=>$Dataset_IDs));
?>
