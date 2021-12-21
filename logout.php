<?php
session_start();
include 'config.php';
$sessId=$_SESSION['role'];
$sesscurrent=$_SESSION['currentSession'];
unset($_SESSION['role']);
unset($_SESSION['currentSession']);
unset($_SESSION['userid']);
header("Location: /login.php",  true,  301);
?>