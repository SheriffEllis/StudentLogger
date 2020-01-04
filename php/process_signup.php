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
$email = clean_input_data($_POST['email']);
$pwd = clean_input_data($_POST['pwd']);
$hash = password_hash($pwd, PASSWORD_DEFAULT);

function clean_input_data($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES);
  return $data;
}

//Remember input values to re-enter if trying again
$_SESSION['usr'] = $usr;
$_SESSION['email'] = $email;
$_SESSION['pwd'] = $pwd;

//Input validation
//Username: must be <=50 characters, only contains letters and whitespace, can't be an empty string
$_SESSION['invld_usr'] = strlen($usr)>50 || !preg_match("/^[a-zA-Z ]*$/", $usr) || empty($usr);

//Check if username already exists if username was valid
if(!$_SESSION['invld_usr']){
  $stmt = $conn->prepare("SELECT Username FROM teacher WHERE Username= ?");
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($result);
  $stmt->fetch();
  //If no results were found username is available
  $_SESSION['usr_unavailable'] = $result != null;
}

//Email: must be <=320 characters, must be valid email
$_SESSION['invld_email'] = strlen($email)>320 || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email);

//Password: at least one number, at least one lower-case and upper-case letter, no whitespaces
$_SESSION['invld_pwd'] = !(preg_match("/\d+/", $pwd) &&
                          preg_match("/[a-z]+/", $pwd) &&
                          preg_match("/[A-Z]+/", $pwd) &&
                          !preg_match("/\s+/", $pwd));

if(!($_SESSION['invld_usr'] || $_SESSION['invld_email'] || $_SESSION['invld_pwd'])){
  //All inputs are valid: create a new user
  //Form prepared statement using input values to create a new user
  $stmt = $conn->prepare("INSERT INTO teacher (Username, Email, Hash) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $usr, $email ,$hash);
  $stmt->execute();
  $conn->close();

  header("Location: ../pages/homepage.php");
}else{
  //Some inputs are invalid: redirect back to signup (with error boxes)
  $conn->close();
  header("Location: ../pages/sign_up_page.php");
}
exit();
?>
