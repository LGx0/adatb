<?php
require_once("oracleconn.php");
if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
?>

		<p> Termékek között itt lehet majd böngészni kategóri alapján. <br/> Illetve ha kiválasztottunk egy terméket akkor megjeleníti egy külön oldalon, ahol azt is megmutatja hogy akik ezt vették milyen termékeket vettek még</p>
		<form method="get" action="termekek.php"> 
		<?php kategoriadropdwon($conn); ?>
		<input type="submit" value="Kiválaszt" name="kivalaszt"/>
		</form>
		<?php if(empty($_GET['kategoriak']))
		{
			echo("<p> Válassz a fenti kategóriák közül </p>");
		}else{
			$kategoria= trim($_GET["kategoriak"]);
			kategoriakilistaz($conn,"$kategoria");
					
		}
			
		?>
