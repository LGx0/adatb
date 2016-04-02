<?php
session_start ();
require_once("oracleconn.php");


$_SESSION["emailErr"] = "";

$_SESSION["jelErr"] = "";

$_SESSION["jel2Err"] = "";

$_SESSION["nevErr"] = "";

$_SESSION["irszamErr"] = "";

$_SESSION["utcaErr"] = "";

$_SESSION["hszErr"] = "";

$_SESSION["bszErr"] = "";


if(!isset($_POST["email"]))
{$_POST["email"] = "";}

if(!isset($_POST["jel"]))
{$_POST["jel"] = "";}

if(!isset($_POST["jel2"]))
{$_POST["jel2"] = "";}

if(!isset($_POST["nev"]))
{$_POST["nev"] = "";}

if(!isset($_POST["irszam"]))
{$_POST["irszam"] = "";}

if(!isset($_POST["utca"]))
{$_POST["utca"] = "";}

if(!isset($_POST["hsz"]))
{$_POST["hsz"] = "";}

if(!isset($_POST["banksz"]))
{$_POST["banksz"] = "";}



if (empty($_POST["email"]))
{ $_SESSION["emailErr"] = "Add meg az emailcímed!" ; }
else if (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)){
 $_SESSION["emailErr"] = "Nem megfelelő e-mail formátum!"; 
  }

if (empty($_POST["jel"]))
	{ 
	$_SESSION["jelErr"] = "Add meg a jelszót!" ; 
	}
if ($_POST["jel2"] != $_POST["jel"])
	{
		$_SESSION["jel2Err"] = "A két jelszó nem egyezik!";
	}
else if (empty($_POST["jel2"]))
	{
		$_SESSION["jel2Err"] = "Itt is add meg a jelszót!" ; 		
	}
if (empty($_POST["nev"]))
	{ 
	$_SESSION["nevErr"] = "Add meg a neved!" ; 
	}
if (empty($_POST["irszam"]))
	{ 
	$_SESSION["irszamErr"] = "Add meg az irányítószámod!" ; 
	}
if (empty($_POST["utca"]))
	{ 
	$_SESSION["utcaErr"] = "Nincs megadva!" ; 
	}
if (empty($_POST["hsz"]))
	{ 
	$_SESSION["hszErr"] = "Nincs megadva!" ; 
	}
if (empty($_POST["banksz"]))
	{ 
	$_SESSION["bszErr"] = "A számlaszám megadása nélkül nem tudsz vásárolni az oldalon!" ; 
	}
$email=$_POST['email'];


if((($_SESSION["emailErr"])== "") and (($_SESSION["jelErr"])=="")
	and (($_SESSION["jel2Err"])=="") and (($_SESSION["nevErr"])=="")
and (($_SESSION["irszamErr"])=="") and (($_SESSION["utcaErr"])=="")
and (($_SESSION["hszErr"])=="") and (($_SESSION["bszErr"])==""))
{
	if(felhaszn_felvesz($conn,$email, $_POST['jel'],$_POST['nev'],$_POST["banksz"],
	$_POST["irszam"],$_POST["utca"],$_POST["hsz"]))
	{ @$_SESSION['felvetelsikeres'] = "A regisztráció megtörtént";}
	else
	{ @$_SESSION['felvetelsikeres'] = "Adatbázis hiba a regisztrációnál";}

}

if($_SESSION['menu'] === "admin"){
	header ('Location:index.php?tartalom=adminvasarlok.php&menu=adminuser');
}else{
	header ('Location:index.php?tartalom=reg.php&menu=reg');
}
//header ('Location:index.php?tartalom=reg.php');



?>