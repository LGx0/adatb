<?php 
	require_once('oracleconn.php');

	$selectstring = ("SELECT * FROM SZALLITASOKVIEW");
	$select = oci_parse($conn,$selectstring);
	oci_execute($select);
	echo "<table class='table-center' border=\"1\">";
?>

<tr><th>Szállítás azonosítója</th><th>Esedékessége</th><th>Vásrálás azonosítója</th><th>Vásárló neve</th><th>Lakhely</th><th>Elküldés</th></tr>
	
<?php
	while ($row = oci_fetch_array($select, OCI_ASSOC+OCI_RETURN_NULLS)) {
			?><form method="post" action="elkuld.php"/> <?php
			echo "<tr>";
				
				
					echo "<td>".$row['ID'] ."</td> <input type=\"hidden\" value=\"".$row['ID'] ."\" name=\"ID\" />";
				
					echo "<td>" .$row['ESEDEKESSEG'] ."</td>";
					
					
					echo " <td>" .$row['VASARLAS_ID'] ."</td>";
					
					echo " <td>" .$row['NEV'] ."</td>";					
					
					echo " <td>" .$row['IRANYITOSZAM'] ." ".$row['VAROS'] ." ".$row['UTCA'] ." ".$row['HAZSZAM'] ."</td>";
					if($row['ELKULDVE'] ==1)
					{
					
					echo " <td>Már kiküldve</td>";
					}else{
						
						?>
						<td><input type="submit" value="Elküld" name="elkuld"/></td><?php
					}
					
					
			
			echo "</tr></form>" ;
	}
	echo "</table>\n";
?>
