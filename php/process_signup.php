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
    $email = cleaninputdata($_POST['email']);
    $pwd = cleaninputdata($_POST['pwd'], false);
    $hash = password_hash($pwd, PASSWORD_DEFAULT);

    //Input validation
    //Username: must be <=50 characters, only contains letters and whitespace, can't be an empty string
    $invld_usr = strlen($usr)>50 || !preg_match("/^[a-z ]*$/", $usr) || empty($usr);

    //Check if username already exists if username was valid
    if(!$invld_usr){
      $stmt = $conn->prepare("SELECT Username FROM teacher WHERE Username=?");
      $stmt->bind_param('s', $usr);
      $stmt->execute();
      $stmt->bind_result($result);
      $stmt->fetch();
      $stmt->close();
      //If no results were found username is available
      $usr_unavailable = $result != null;
    }

    //Email: must be <=320 characters, must be valid email
    $invld_email = strlen($email)>320 || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email);

    //Password: at least one number, at least one lower-case and upper-case letter, no whitespaces
    $invld_pwd = !(preg_match("/\d+/", $pwd) &&
                              preg_match("/[a-z]+/", $pwd) &&
                              preg_match("/[A-Z]+/", $pwd) &&
                              !preg_match("/\s+/", $pwd));

    if(!($invld_usr || $usr_unavailable || $invld_email || $invld_pwd)){
      //All inputs are valid: create a new user
      //Form prepared statement using input values to create a new user
      $stmt = $conn->prepare("INSERT INTO teacher (Username, Email, Hash) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $usr, $email ,$hash);
      $stmt->execute();
      $stmt->close();
      $conn->close();

      //Once user has been created, go to homepage logged in
      $_SESSION['usr'] = $usr;
      header("Location: /StudentLogger/pages/homepage.php");
    }else{
      //Some inputs are invalid: redirect back to signup (with error boxes)
      $conn->close();
    }
  }
?>
