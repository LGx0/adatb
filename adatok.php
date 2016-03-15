<?php 
require_once('oracleconn.php');
if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
?>

		<h2>Felhasználói adatok</h2>
		<?php felhasznaloi_adatok($conn, $_SESSION["azon"]); ?>
		<h2>Egyenleg feltöltése</h2><p>Maximum 100000 Ft feltöltése lehetséges egyszerre </p>
		<form method ="post" action="feltolt.php">
		<input type="number" min="0" max="100000" step="100" value="0" name="osszeg"/>
		<input type="submit" value="Feltölt" name="submit"/>
		<p><?php  echo @$_SESSION['tranzakcio_eredmeny']; ?> </p>
		<?php $_SESSION['tranzakcio_eredmeny'] = "";?>
		</form>
		<h2>A már megvett termékek</h2>
		<?php vasarolt_termekek($conn, $_SESSION["azon"]); ?>
