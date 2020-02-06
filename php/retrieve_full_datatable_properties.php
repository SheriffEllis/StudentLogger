<?php
  $conn = new mysqli(getenv("HTTP_HOST"), getenv("HTTP_USER"), getenv("HTTP_PASS"), getenv("HTTP_DATABASE"));
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $Data_table_ID = $_POST["Data_table_ID"];

  $stmt = $conn->prepare("SELECT Table_title, Table_description FROM data_table WHERE Data_table_ID=? LIMIT 1");
  $stmt->bind_param("i", $Data_table_ID);
  $stmt->execute();
  $stmt->bind_result($Title, $Description);
  $stmt->fetch();
  $stmt->close();

  $stmt = $conn->prepare("SELECT Dataset_ID FROM dataset WHERE Data_table_ID=? ORDER BY Value_number ASC");
  $stmt->bind_param("i", $Data_table_ID);
  $stmt->execute();
  $stmt->bind_result($Dataset_ID);
  $Dataset_IDs = array();
  while($stmt->fetch()){
    array_push($Dataset_IDs, $Dataset_ID);
  }

  $conn->close();

  echo json_encode(array("Title"=>$Title, "Description"=>$Description, "Dataset_IDs"=>$Dataset_IDs));
?>
