<?php
session_start();
//Form connection with local SQL server using details in .htaccess file
$conn = new mysqli(
  getenv('HTTP_HOST'),
  getenv('HTTP_USER'),
  getenv('HTTP_PASS'),
  getenv('HTTP_DATABASE')
);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Clean inputs to prevent cross-site scripting attacks
$usr = clean_input_data($_POST['usr']);
$pwd = clean_input_data($_POST['pwd']);

function clean_input_data($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data,ENT_QUOTES);
  return $data;
}

//If "Remember me" tickbox was clicked, set session variable to true
$_SESSION['remember'] = !empty($_POST['remember']);

//Form prepared statement searching for user's hash
$stmt = $conn->prepare("SELECT Hash FROM teacher WHERE Username= ?");
$stmt->bind_param('s', $usr);
$stmt->execute();
$stmt->bind_result($result);
$stmt->fetch();
$conn->close();

if($result != null){
  $hash = $result;
}

$_SESSION['wrng_pwd'] = false;
$_SESSION['wrng_usr'] = false;
if(isset($hash)){
  if(password_verify($pwd, $hash)){
    //Access granted
    $_SESSION['usr'] = $_POST['usr'];
    header("Location: ../pages/homepage.php");
  }else{
    //Access denied: wrong password
    $_SESSION['wrng_pwd'] = true;
    header("Location: ../index.php");
  }
}else{
  //Access denied: wrong username
  $_SESSION['wrng_usr'] = true;
  header("Location: ../index.php");
}
exit();
?>
