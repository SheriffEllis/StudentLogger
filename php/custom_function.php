<?php
function customFunction($Function_type, $inputs = null){
  switch($Function_type){
    case 0:
      $functionName = 'SUM';
      if($inputs == null){return $functionName;}
      $sum = 0;
      foreach($inputs as $num){
        $sum += $num;
      }
      return array('functionName'=>$functionName, 'output'=>$sum);
    case 1:
      $functionName = 'AVERAGE';
      if($inputs == null){return $functionName;}
      $sum = 0;
      foreach($inputs as $num){
        $sum += $num;
      }
      $average = $sum/count($inputs);
      return array('functionName'=>$functionName, 'output'=>$average);
    default: return null;
  }
}
?>
