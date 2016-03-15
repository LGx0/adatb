<?php

require_once("oracleconn.php");


$nev = trim($_POST['nev']);
$kategoria = trim($_POST['kategoria']);
$beszar = trim($_POST['beszar']);
$eladar = trim($_POST['eladar']);


$insertstirng=("INSERT INTO TERMEKEK (NEV,KATEGORIA, BESZ_AR,ELAD_AR, ELADOTT_MENNYISEG, FELVETEL_DATUMA )VALUES  
('$nev','$kategoria' , '$beszar','$eladar','0', SYSDATE)");
$insert=oci_parse($conn,$insertstirng);
oci_execute($insert);

/*header('Location:admintermekek.php');*/




?>