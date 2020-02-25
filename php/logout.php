<?php
  session_start();
  unset($_SESSION['usr']);
  header("Location: /StudentLogger/index.php");
?>
