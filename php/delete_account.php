<?php
session_start();
$conn = new mysqli(getenv('HTTP_HOST'), getenv('HTTP_USER'), getenv('HTTP_PASS'), getenv('HTTP_DATABASE'));
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$usr = $_SESSION['usr'];

$stmt = $conn->prepare('DELETE FROM teacher WHERE Username=?');
$stmt->bind_param('s', $usr);
$stmt->execute();
$stmt->close();
$conn->close();

unset($_SESSION['usr']);
header('Location: /StudentLogger/index.php');
?>
