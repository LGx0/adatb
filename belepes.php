<?php
session_start ();
require_once("oracleconn.php");


$_SESSION["emailError"] = "";

$_SESSION["jelError"] = "";
if(!isset($_POST["email"]))
{$_POST["email"] = "";}
if(!isset($_POST["jel"]))
{$_POST["jel"] = "";}

if (empty($_POST["jel"]))
{ $_SESSION["jelError"] = "Add meg a jelszot" ; }

if (empty($_POST["email"]))
{ $_SESSION["emailError"] = "Add meg a felhasznalonevet" ; 
}
else 
{
	$email=$_POST['email'];
	felhasznalo_email_alapjan($conn, "'$email'", $_POST['jel']);
}

$_SESSION["azon"] = $_POST["email"];



if(($_POST['email'] =="admin") and ($_POST['jel']=="admin"))
{
	$_SESSION['menu'] = "admin";
	header('Location:index.php?tartalom=admintermekek.php&menu=admin');
}else
if(($_POST['email'] =="adminuser") and ($_POST['jel']=="admin"))
{
	header('Location:index.php?tartalom=adminvasarlok.php&menu=adminuser');
}

else if((($_SESSION["jelError"])== "") and (($_SESSION["emailError"])==""))
{
	$_SESSION['azon'] = $_POST['email'];
	@$_SESSION['kosarban']=0;
	$_SESSION['kosar']=array();
	$_SESSION['vegosszeg']=0;
	
header('Location:index.php?tartalom=fooldal.php&menu=fooldal');
} else {
header ('Location: index.php');
}



?>