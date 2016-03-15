<?php

require_once("oracleconn.php");

$id = $_POST['ID'];

$updatestirng=("UPDATE SZALLITASOK SET ELKULDVE = '1' WHERE ID ='$id'");
$update=oci_parse($conn,$updatestirng);
oci_execute($update);

header('Location:index.php?tartalom=adminszallitasok.php&menu=admin');




?>