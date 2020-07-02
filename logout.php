<?php
session_start();
unset($_SESSION['username']);
echo "<script> alert('Logout success!') </script>";
header("refresh:0.5;index.php");
?>