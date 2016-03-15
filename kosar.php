<?php require_once('oracleconn.php'); 

if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
?>

	<?php
	echo "<table border='1'>\n";
	?>
	<tr><th>játék neve</th> <th> kategória</th> <th> ár </th> <th>mennyiség</th> <th>összeg</th> <th>tétel törlése</th></tr>
	<?php
		$_SESSION['vegosszeg'] = 0;
		
		foreach($_SESSION['kosar'] as $termekkod => $mennyiseg)
		{
			vasarolni_kivant_termekek($conn,$termekkod,$mennyiseg);
		} 
		
		echo "</table>\n";
		
		
	
	echo "<p>Fizetendő összeg:" . $_SESSION['vegosszeg'] . "</p>";	
	 
	 IF($_SESSION['vegosszeg'] > 0) { ?>
	<form method="post" action="megvesz.php">
		<input type="submit" value="Megvesz" name="megvesz"/>
	</form>
	 <?php } ?>
	<p> <?php echo @$_SESSION['sikeresvasarlas']; ?> </p>
	<?php $_SESSION['sikeresvasarlas'] = "";
	?>
 		
