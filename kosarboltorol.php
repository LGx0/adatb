<?php
session_start ();
require_once("oracleconn.php");

$termekkod = trim($_POST['termekkod']);
$mennyiseg = trim($_POST['mennyiseg']);
echo $termekkod;
unset($_SESSION['kosar']["$termekkod"]);
$_SESSION['kosarban'] -= $mennyiseg;

header("Location:". $_SERVER['HTTP_REFERER']);


?>