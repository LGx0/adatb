<?php 
require_once('oracleconn.php');
if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
if(isset($_GET['egyenleg'])) $egyenleg=$_GET['egyenleg'];
?>
	<fieldset class="table-center" style="width:60%"> 
		<legend><b>Felhasználói adatok</b></legend>
		<?php felhasznaloi_adatok($conn, $_SESSION["azon"]); ?>
	</fieldset>
	<h3 class="text-center"><a name="egyenleg"></a>Egyenleg feltöltése</h3>
	<p>Maximum 100000 Ft feltöltése lehetséges egyszerre </p>
	<form method ="post" action="feltolt.php">
		<input type="number" min="0" max="100000" step="100" value="0" name="osszeg" <?php if(isset($egyenleg)) echo "autofocus"; ?>/>
		<input type="submit" value="Feltölt" name="submit"/>
		<p><?php  echo @$_SESSION['tranzakcio_eredmeny']; ?> </p>
		<?php $_SESSION['tranzakcio_eredmeny'] = "";?>
	</form>
	<h3 class="text-center">A már megvett termékek</h3>
	<?php vasarolt_termekek($conn, $_SESSION["azon"]); ?>
