<?php

require_once("oracleconn.php");


$nev = trim($_POST['nev']);
$kod = trim($_POST['kod']);
$beszar = trim($_POST['beszar']);
$eladar = trim($_POST['eladar']);


$updatestirng=("UPDATE TERMEKEK SET 
NEV = '$nev',
BESZ_AR = '$beszar',
ELAD_AR = '$eladar'
 WHERE KOD ='$kod'");
$update=oci_parse($conn,$updatestirng);
oci_execute($update);

header('Location:index.php?tartalom=admintermekek.php&menu=admin');




?>