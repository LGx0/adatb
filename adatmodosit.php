<?php
session_start ();
require_once("oracleconn.php");




$_SESSION["jelErr2"] = "";

$_SESSION["jel2Err2"] = "";

$_SESSION["nevErr2"] = "";

$_SESSION["irszamErr2"] = "";

$_SESSION["utcaErr2"] = "";

$_SESSION["hszErr2"] = "";

$_SESSION["bszErr2"] = "";

if(!isset($_POST["jelsz"]))
{$_POST["jelsz"] = "";}



if(!isset($_POST["ujjelsz"]))
{$_POST["ujjelsz"] = "";}

if(!isset($_POST["ujjelsz2"]))
{$_POST["ujjelsz2"] = "";}

if(!isset($_POST["irsz"]))
{$_POST["irsz"] = "";}

if(!isset($_POST["utca"]))
{$_POST["utca"] = "";}

if(!isset($_POST["hsz"]))
{$_POST["hsz"] = "";}

if(!isset($_POST["banksz"]))
{$_POST["banksz"] = "";}


$email = $_SESSION['azon'];



	$jelszo = trim($_POST['jelsz']);
	echo $jelszo;
	
 if ($_POST["ujjelsz2"] != $_POST["ujjelsz"])
	{
		$_SESSION["jel2Err2"] = "A két jelszó nem egyezik!";
}else if ($_POST['ujjelsz'] != ""){
		$jelszo=trim($_POST["ujjelsz2"]);
	}
	
	echo $jelszo;


if (empty($_POST["irsz"]))
	{ 
	$_SESSION["irszamErr2"] = "Nem adtál meg új irányítószámat" ; 
}else{
		$irsz = $_POST["irsz"];
	}

if (empty($_POST["utca"]))
	{ 
	$_SESSION["utcaErr2"] = "Nem adtál meg új utcát!" ; 
}else{
		$utca=$_POST['utca'];
	}

if (empty($_POST["hsz"]))
	{ 
	$_SESSION["hszErr2"] = "Nem adtál meg új házszámot!" ; 
}else{
		$hsz=$_POST["hsz"];
	}

if (empty($_POST["banksz"]))
	{ 
	$_SESSION["bszErr2"] = "Nem adtál meg új számlaszámot!" ; 
}else{
		$banksz = $_POST['banksz'];
	}



if((($_SESSION["emailErr2"])== "") and (($_SESSION["jelErr2"])=="")
	and (($_SESSION["jel2Err2"])=="") and (($_SESSION["nevErr2"])=="")
and (($_SESSION["irszamErr2"])=="") and (($_SESSION["utcaErr2"])=="")
and (($_SESSION["hszErr2"])=="") and (($_SESSION["bszErr2"])==""))
{
	if(felhaszn_modosit($conn,$email, $jelszo,$banksz,$irsz,$utca,$hsz))
	{
		@$_SESSION['sikeresmodositas'] = "Az adataid módosultak";	
	}


	else
	{
		@$_SESSION['sikeresmodositas'] = "Adatbázis hiba a módosítás közben";
	}
	
}else{
	@$_SESSION['sikeresmodositas'] = "Nem jól adatd meg az adatokat";
}



header('Location:index.php?tartalom=adatok.php&menu=fooldal');

?>