<?php
  session_start();
  $conn = new mysqli(
    getenv('HTTP_HOST'),
    getenv('HTTP_USER'),
    getenv('HTTP_PASS'),
    getenv('HTTP_DATABASE')
  );
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $usr = htmlspecialchars($_POST['usr'],ENT_QUOTES);
  $pwd = htmlspecialchars($_POST['pwd'],ENT_QUOTES);

  $_SESSION['remember'] = isset($_POST['remember']);
  $_SESSION['usr'] = $usr;
  $_SESSION['pwd'] = $pwd;

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
      header("Location: ../pages/homepage.php");
      exit();
    }else{
      //Access denied: wrong password
      $_SESSION['wrng_pwd'] = true;
      header("Location: ../index.php");
      exit();
    }
  }else{
    //Access denied: wrong username
    $_SESSION['wrng_usr'] = true;
    header("Location: ../index.php");
    exit();
  }
?>
