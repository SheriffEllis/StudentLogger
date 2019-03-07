<?php
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
  $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
  $pwd = htmlspecialchars($_POST['pwd'],ENT_QUOTES);
  $hash = password_hash($pwd, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, email, hash) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $usr, $email ,$hash);
  $stmt->execute();
  $conn->close();
?>
<html>
<body>
<a href="../pages/sign_up.php"> Back</a>
</body>
</html>
