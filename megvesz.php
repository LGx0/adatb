<?php
session_start ();
require_once("oracleconn.php");
$vasarlo_egyenlege = mennyipenzevan($conn,$_SESSION['azon']);
if ($_SESSION['vegosszeg'] > $vasarlo_egyenlege)
{
	$_SESSION['sikeresvasarlas'] = "<p>Nincs elég pénz az egyenlegeden a vásárláshoz! Az alábbi linkre kattintva feltöltheted az egyenleged:</p> <p><a href='index.php?tartalom=adatok.php&menu=fooldal&egyenleg#egyenleg'>Egyenleg feltöltés</a></p>";
}else{
	vasarlo_egyenleg_csokk($conn,$_SESSION['azon'],$_SESSION['vegosszeg']);
	megvasarol($conn,$_SESSION['azon']);
	$_SESSION['kosarban'] = 0;
	$_SESSION['kosar'] = array();
	$_SESSION['sikeresvasarlas'] = "A vásárlás sikeresen megtörtént";
	
}
header("Location:". $_SERVER['HTTP_REFERER']);	

?>