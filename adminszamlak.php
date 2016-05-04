<?php 
	require_once('oracleconn.php'); 

	$selectstring = ("SELECT * FROM SZAMLAKVIEW");
	$select = oci_parse($conn,$selectstring);
	oci_execute($select);
	echo "<table class='table-center' border=\"1\">";
?>

<tr><th>ÖSSZEG</th><th>Áfa</th><th>Számla sorszáma</th><th>Kiállítás dátuma</th><th>Vásárlás azonosítója</th><th>Vásárló neve</th><th>Vásárló lakhelye</th></tr>

<?php
	while ($row = oci_fetch_array($select, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>";
				
				
					echo "<td>".$row['OSSZEG'] ."</td>";
					
					echo "<td>".$row['AFA'] ."</td>";
				
					echo "<td>" .$row['SORSZAM'] ."</td>";
					
					
					echo " <td>" .$row['KELTE'] ."</td>";
					
					echo " <td>" .$row['VASARLAS_ID'] ."</td>";
					
					echo " <td>" .$row['NEV'] ."</td>";
					
					echo " <td>" .$row['IRANYITOSZAM'] ." ".$row['VAROS'] ." ".$row['UTCA'] ." ".$row['HAZSZAM'] ."</td>";
					
					
			
			echo "</tr>";
	}
	echo "</table>\n";
?>
