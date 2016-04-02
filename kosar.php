<?php require_once('oracleconn.php'); 

if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
?>
	<div class="kosar text-center">
		<div class="tartalma text-center">
			<?php
				echo "<table class='table-center' border='1'>\n";
			?>
			<tr><th>Játék neve</th> <th> Kategória</th> <th> Ár </th> <th>Mennyiség</th> <th>Összeg</th> <th>Tétel törlése</th></tr>
			<?php
				$_SESSION['vegosszeg'] = 0;
				
				foreach($_SESSION['kosar'] as $termekkod => $mennyiseg)
				{
					vasarolni_kivant_termekek($conn,$termekkod,$mennyiseg);
				} 
				
				echo "</table>\n";
				
				
			
				echo "<p>Fizetendő összeg: " . $_SESSION['vegosszeg'] . " Ft</p>";	
				 
				 IF($_SESSION['vegosszeg'] > 0) { ?>
				<form method="post" action="megvesz.php">
					<input type="submit" value="Megvesz" name="megvesz"/>
				</form>
			 <?php } ?>
			<p> <?php echo @$_SESSION['sikeresvasarlas']; ?> </p>
			<?php $_SESSION['sikeresvasarlas'] = "";
			?>
		</div>
	</div>
 		
