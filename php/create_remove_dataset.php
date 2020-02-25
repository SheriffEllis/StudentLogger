<?php
  function create_dataset($conn, $POST){
    $sql = "INSERT INTO dataset (Value_number, Value_name, Query) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $Value_number, $Value_name, $Query);

    //Acquire values from select dataset form post
    $Value_number = $POST["Dataset_index"];     //Dataset Value_number in database
    $Value_name = $POST["dataset_name"];        //Dataset Value_name in database

    $selected_table = $POST["selected_table"];  //Which table the query is being performed on
    $output_field = $POST["output_field"];      //Which field of the table is being output
    $order_field = $POST["order_field"];        //Which field is the output ordered by
    $order = $POST["order"];                    //Ascending or Descending order

    $conditions = "";
    //Check if each condition was ticked in the form
    if(isset($POST["ticked"])){
      $conditions = "WHERE ";
      $ticked = $POST["ticked"];
      $investigated_field = $POST["investigated_field"];
      $comparator = $POST["comparator"];
      $compared_value = $POST["compared_value"];

      if(isset($POST["logic_operator"])){
        $logic_operator = $POST["logic_operator"];
      }else{
        $logic_operator = array(); //empty array
      }

      for($i = 0; !empty($ticked[$i]); $i++){
        $conditions = $conditions . " " . $investigated_field[$i] . $comparator[$i] . "'" . $compared_value[$i] . "' ";
        if(!empty($ticked[$i+1])){$conditions = $conditions . $logic_operator[$i] . " ";}
      }
    }
    $Query = "SELECT $output_field FROM $selected_table $conditions ORDER BY $order_field $order";

    $stmt->execute();
    $stmt->close();
    $result = $conn->query("SELECT LAST_INSERT_ID() AS Dataset_ID");
    $row = $result->fetch_assoc();
    $new_dataset_ID = $row["Dataset_ID"];
    return $new_dataset_ID;
  }

  function remove_dataset($conn, $Dataset_ID){
    return $conn->query("DELETE FROM dataset WHERE Dataset_ID=$Dataset_ID");
  }
?>
