<?php 
require_once('oracleconn.php'); 

if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
$_SESSION['menu'] = "fooldal";
?>
	<!--<p> Ide jön majd az új termékek (5-5 katgóriánként)és a legnépszerűbb termékek ajánlása</p>-->
	<h2> Legnépszerűbb termékeink </h2>
	<?php legnepszerubb($conn); ?>
	<h2> Új termékeink </h2>
	<?php kategoriak($conn); ?>


