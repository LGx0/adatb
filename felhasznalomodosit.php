<?php

require_once("oracleconn.php");

if(isset($_POST['nev'])){$nev = trim($_POST['nev']);};
if(isset($_POST['email'])){$email = trim($_POST['email']);};
if(isset($_POST['banksz'])){$banksz = trim($_POST['banksz']);};
if(isset($_POST['egyenleg'])){$egyenleg = trim($_POST['egyenleg']);};
if(isset($_POST['irszam'])){$irszam = trim($_POST['irszam']);};
if(isset($_POST['utca'])){$utca = trim($_POST['utca']);};
if(isset($_POST['hszam'])){$hszam = trim($_POST['hszam']);};

if(isset($_POST['email'])){
	$selectuser = ("SELECT * FROM VASARLOK INNER JOIN IRANYITOSZAM
			ON VASARLOK.IRANYITOSZAM=IRANYITOSZAM.IRANYITOSZAM WHERE EMAIL ='$email'");
		$select = oci_parse($conn,$selectuser);
		oci_execute($select);
		
	$update = null;
	while ($row = oci_fetch_array($select, OCI_ASSOC+OCI_RETURN_NULLS)) {
		if(	$row['NEV'] !== $nev ||
			$row['BANKSZAMLASZAM'] !== $banksz ||
			$row['EGYENLEG'] !== $egyenleg ||
			$row['IRANYITOSZAM'] !== $irszam ||
			$row['UTCA'] !== $utca ||
			$row['HAZSZAM'] !== $hszam
		){
			$update = true;
		}else{
			$update = false;
		}
	};
	//var_dump($update);

	if($update === true){
		$updatestirng=("UPDATE VASARLOK SET 
		NEV = '$nev',
		BANKSZAMLASZAM = '$banksz',
		EGYENLEG = $egyenleg,
		IRANYITOSZAM = $irszam,
		UTCA = '$utca',
		HAZSZAM = '$hszam'
		 WHERE EMAIL ='$email'");
		$update=oci_parse($conn,$updatestirng);
		oci_execute($update);
		header('Location:index.php?tartalom=adminvasarlok.php&menu=adminuser');
	}
	if($update === false){
		var_dump($email);
		$deleteuser=("DELETE FROM VASARLOK
		WHERE EMAIL = '$email'");
		$delete=oci_parse($conn,$deleteuser);
		oci_execute($delete);
		header('Location:index.php?tartalom=adminvasarlok.php&menu=adminuser');
	}
}
	

?>