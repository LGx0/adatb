<?php
session_start ();
require_once("oracleconn.php");

$_SESSION['kosarban'] = $_SESSION['kosarban'] + $_POST['mennyiseg'];
$mennyiseg = trim($_POST['mennyiseg']);
$termekkod = trim($_POST['termekkod']);

$_SESSION['kosar']["$termekkod"] += $mennyiseg;


header("Location:". $_SERVER['HTTP_REFERER']);


?>