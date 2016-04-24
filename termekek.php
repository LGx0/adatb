<?php
require_once("oracleconn.php");
if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
?>

		<p> Termékek között itt lehet böngészni kategória alapján. <br/> Illetve ha kiválasztottunk egy terméket akkor megjeleníti egy külön oldalon, ahol azt is megmutatja hogy akik ezt vették milyen termékeket vettek még</p>
		<?php kategoriak($conn); ?>