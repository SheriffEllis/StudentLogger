<?php
  session_start();
  $title = 'View Function Output';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Function_ID = $_POST['Function_ID'];

  $sql = "SELECT Function_title, Function_description, Function_type FROM function WHERE Function_ID=$Function_ID";
  $stmt = $conn->prepare($sql);
  $stmt->bind_result($Title, $Description, $Function_type);
  $stmt->execute();
  $stmt->fetch();
  $stmt->close();

  $sql = "SELECT Dataset_ID, Value_name, Value_number, Query FROM dataset WHERE Function_ID=$Function_ID ORDER BY Value_number ASC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_result($Dataset_ID, $Value_name, $Value_number, $Query);
  $stmt->execute();
  $Datasets = array();
  while($stmt->fetch()){
    $Datasets[$Value_number] = array("Dataset_ID"=>$Dataset_ID, "Value_name"=>$Value_name, "Query"=>$Query);
  }
  $stmt->close();

  include($current_path . "/php/custom_function.php");
  require($current_path . "/templates/navbar.php");
?>
<div class="container">
  <div class="row text-center">
    <a class="btn btn-primary btn-regular col-centered" href="data_representation_page.php">Back</a>
  </div>

  <div id="buffer-box-small"></div>

  <div class="row row-padded text-center">
    <label class="label-text"><?php echo $Title; ?></label>
  </div>

  <div class="row row-padded">
    <p class="tb-padding box col-lg-6 col-centered output-text"><?php echo $Description; ?></p>
  </div>

  <div id="buffer-box-small"></div>

  <div class="row row-padded text-center">
    <p class="output-text"><?php echo customFunction($Function_type); ?></p>
  </div>

  <!-- TODO: enter actual function values and output -->
  <table class="col-centered">
    <?php
      function retrieveColumn($conn, $Dataset){
        $Query = $Dataset["Query"];
        $stmt = $conn->prepare($Query);
        if($stmt){
          $stmt->execute();
          $stmt->bind_result($result);
          $results = array();
          while($stmt->fetch()){
            array_push($results, $result);
          }
          return $results;
        }else{
          return "Error";
        }
      }

      function isRowEmpty($columns, $rowNumber){
        foreach($columns as $column){
          if(isset($column[$rowNumber])){return false;}
        }
        return true;
      }

      $tableHeaders = "<tr>";
      $columns = array();
      foreach($Datasets as $Value_number => $Dataset){
        $columns[$Value_number] = retrieveColumn($conn, $Dataset);
        $Value_name = $Dataset["Value_name"];
        $tableHeaders = $tableHeaders . "<th>$Value_name</th>";
      }
      $tableHeaders = $tableHeaders . "<th>Output</th></tr>";
      echo $tableHeaders;

      for($rowNumber = 0; !isRowEmpty($columns, $rowNumber); $rowNumber++){
        $rowString = "<tr>";
        $inputs = array();
        foreach($columns as $column){
          if(isset($column[$rowNumber])){
            $value = $column[$rowNumber];
          }else{
            $value = "";
          }
          $rowString = $rowString . "<td>$value</td>";
          array_push($inputs, $value);
        }
        $output = customFunction($Function_type, $inputs);
        $rowString = $rowString . "<td>$output</td></tr>";
        echo $rowString;
      }
    ?>
  </table>

</div>

<div id="buffer-box"></div>
</body>
</html>
