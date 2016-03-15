<?php
session_start ();
require_once("oracleconn.php");
	unset($_SESSION['azon']);
	unset($_SESSION['kosarban']);
	unset($_SESSION['kosar']);
	unset($_SESSION['vegosszeg']);

header ('Location: index.php');




?>