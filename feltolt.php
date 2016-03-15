<?php
session_start ();
require_once("oracleconn.php");

if (!egyenlegfeltolt($conn,$_SESSION["azon"],$_POST['osszeg']))
	{$_SESSION['tranzakcio_eredmeny'] = "A feltöltés sikeres";}
else{
	$_SESSION['tranzakcio_eredmeny'] = "A feltöltés sikertelen";
}

header('Location:index.php?tartalom=adatok.php&menu=fooldal');
 



?>