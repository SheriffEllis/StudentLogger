<?php
  session_start();
  $host = "localhost";
  $sqlUser = "root";
  $sqlPass = "Atheros017";
  $database = "student_logger";
  $conn = new mysqli($host, $sqlUser, $sqlPass, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $usr = htmlspecialchars($_POST['usr']);
  $pwd = htmlspecialchars($_POST['pwd']);
  if(isset($_POST['remember'])){
    $_SESSION['usr'] = $usr;
    $_SESSION['pwd'] = $pwd;
  }

  $result = $conn->query("SELECT hash FROM users WHERE username='$usr'");
  if($result->num_rows > 0){
    $hash = $result->fetch_assoc()['hash'];
  }

  if(isset($hash)){
    if(password_verify($pwd, $hash)){
      echo "Access granted";
    }else{
      echo "Access denied";
    }
  }else{
    echo "Usernamer does not exist";
  }
  $conn->close();
?>

<html>
<body>
<a href="../index.php"> Back</a>
</body>
</html>
