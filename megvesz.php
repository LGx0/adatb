<?php
session_start ();
require_once("oracleconn.php");
$vasarlo_egyenlege = mennyipenzevan($conn,$_SESSION['azon']);
if ($_SESSION['vegosszeg'] > $vasarlo_egyenlege)
{
	$_SESSION['sikeresvasarlas'] = "Nincs elég pénz az egyenlegeden a vásárláshoz!";
}else{
	vasarlo_egyenleg_csokk($conn,$_SESSION['azon'],$_SESSION['vegosszeg']);
	megvasarol($conn,$_SESSION['azon']);
	$_SESSION['kosarban'] = 0;
	$_SESSION['kosar'] = array();
	$_SESSION['sikeresvasarlas'] = "A vásárlás sikeresen megtörtént";
	
}
header("Location:". $_SERVER['HTTP_REFERER']);	

?>