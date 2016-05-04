<?php
require_once("oracleconn.php");
if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
$keres = false;
if(isset($_GET['keres'])) $keres=$_GET['keres'];
?>

		<p> Termékek között itt lehet böngészni kategória alapján. <br/> Illetve ha kiválasztottunk egy terméket akkor megjeleníti egy külön oldalon, ahol azt is megmutatja hogy akik ezt vették milyen termékeket vettek még</p>
		<form method="post" <?php if (isset($_POST["keres"])){ echo "action=\"index.php?tartalom=termekek.php&menu=fooldal&keres=".$_POST["keres"]."\"";} ?>>
			<input type="text" placeholder="Keresés" name="keres" id="keres"/>
			<input type="submit" value="Keresés"/>
		</form>
		<?php 
			if($keres === false){
				kategoriak($conn);
			}else{
				keres($conn,$keres);
			}
			
		?>