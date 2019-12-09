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

  //TODO Input validation

  $usr = htmlspecialchars($_POST['usr'],ENT_QUOTES);
  $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
  $pwd = htmlspecialchars($_POST['pwd'],ENT_QUOTES);
  $hash = password_hash($pwd, PASSWORD_DEFAULT);
  
  //TODO: implement entry of remaining values
  $name = "Blank";
  $surname = "Blank";
  $sex = 'M';

  $stmt = $conn->prepare("INSERT INTO teacher (Username, First_name, Last_name, Sex, Email, Hash) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $usr, $name, $surname, $sex, $email ,$hash);
  $stmt->execute();
  $conn->close();

  $_SESSION['usr'] = $usr;
  $_SESSION['pwd'] = $pwd;

  header("Location: ../pages/homepage.php");
  exit();
?>
