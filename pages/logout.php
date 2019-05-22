<?php
session_start();
$_SESSION["id"];
$_SESSION["username"];

unset($_SESSION["id"]);
unset($_SESSION["username"]);

session_unset();
session_destroy();

header("location:login.php");
?>