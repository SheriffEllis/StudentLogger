<?php
function customFunction($Function_type, $inputs = null){
  switch($Function_type){
    case 0:
      //SUM
      $functionName = "SUM";
      if($inputs == null){return $functionName;}
      $sum = 0;
      foreach($inputs as $num){
        if(gettype($num) != "integer"){return "Error";}
        $sum += $num;
      }
      return $sum;
    case 1:
      //AVERAGE
      $functionName = "AVERAGE";
      if($inputs == null){return $functionName;}
      $sum = 0;
      foreach($inputs as $num){
        if(gettype($num) != "integer"){return "Error";}
        $sum += $num;
      }
      $average = $sum/count($inputs);
      return $average;
    default: return null;
  }
}
?>
