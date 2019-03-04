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
  if(isset($_POST['remember'])){
    $_SESSION['usr'] = $usr;
    $_SESSION['pwd'] = $pwd;
  }

  $stmt = $conn->prepare("SELECT hash FROM users WHERE username= ?");
  $stmt->bind_param('s', $usr);
  $stmt->execute();
  $stmt->bind_result($result);
  $stmt->fetch();

  if($result != null){
    $hash = $result;
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
