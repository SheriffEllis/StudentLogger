<?php
include($current_path . '/php/clean_input_data.php');

if(!empty($_POST['submitted'])){
  //Form connection with local SQL server using details in .htaccess file
  $conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  //Clean inputs to prevent cross-site scripting attacks
  $usr = cleaninputdata($_POST['usr']);
  $pwd = cleaninputdata($_POST['pwd'], false);

  //If "Remember me" tickbox was clicked, set session variable to true otherwise, false
  $_SESSION['remember'] = !empty($_POST['remember']);

  //Form prepared statement searching for user's hash
  $stmt = $conn->prepare("SELECT Hash FROM teacher WHERE Username=?");
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($result);
  $stmt->fetch();
  $stmt->close();
  $conn->close();

  if($result != null){
    $hash = $result;
  }

  $wrng_pwd = false;
  $wrng_usr = false;
  if(!empty($hash)){
    if(password_verify($pwd, $hash)){
      //Access granted
      $_SESSION['usr'] = $_POST['usr'];
      header("Location: /StudentLogger/pages/homepage.php");
    }else{
      //Access denied: wrong password
      $wrng_pwd = true;
    }
  }else{
    //Access denied: wrong username
    $wrng_usr = true;
  }
}
?>
