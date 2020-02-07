<?php
  session_start();
  $title = 'View Table';
  $web_section = 'data_representation';
  $current_path = getenv('CURRENT_PATH');

  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $Data_table_ID = $_POST['Data_table_ID'];

  $sql = "SELECT Table_title, Table_description FROM data_table WHERE Data_table_ID=$Data_table_ID";
  $stmt = $conn->prepare($sql);
  $stmt->bind_result($Title, $Description);
  $stmt->execute();
  $stmt->fetch();
  $stmt->close();

  $sql = "SELECT Dataset_ID, Value_name, Value_number, Query FROM dataset WHERE Data_table_ID=$Data_table_ID ORDER BY Value_number ASC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_result($Dataset_ID, $Value_name, $Value_number, $Query);
  $stmt->execute();
  $Datasets = array();
  while($stmt->fetch()){
    $Datasets[$Value_number] = array("Dataset_ID"=>$Dataset_ID, "Value_name"=>$Value_name, "Query"=>$Query);
  }
  $stmt->close();

  require($current_path . '/templates/navbar.php');
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

    <!-- TODO: enter actual table values -->
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
            return null;
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
        $tableHeaders = $tableHeaders . "</tr>";
        echo $tableHeaders;

        for($rowNumber = 0; !isRowEmpty($columns, $rowNumber); $rowNumber++){
          $rowString = "<tr>";
          foreach($columns as $column){
            if(isset($column[$rowNumber])){
              $value = $column[$rowNumber];
            }else{
              $value = "";
            }
            $rowString = $rowString . "<td>$value</td>";
          }
          $rowString = $rowString . "</tr>";
          echo $rowString;
        }
      ?>
    </table>

  </div>

  <div id="buffer-box"></div>
</body>
</html>
