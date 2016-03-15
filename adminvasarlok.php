<?php 
	require_once('oracleconn.php');

	$selectstring = ("SELECT * FROM VASARLOK INNER JOIN IRANYITOSZAM
		ON VASARLOK.IRANYITOSZAM=IRANYITOSZAM.IRANYITOSZAM");
	$select = oci_parse($conn,$selectstring);
	oci_execute($select);
	echo "<table class='table-center' border=\"1\">";
?>
<h1>Vásárlók adatai</h1>
<tr><th>Név</th><th>Jelszó</th><th>Email</th><th>Regisztrált</th><th>Számlaszám</th><th>Egyenleg</th><th>Lakhely</th></tr>

<?php
	while ($row = oci_fetch_array($select, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>";
				
				
					echo "<td>".$row['NEV'] ."</td>";
				
					echo "<td>" .$row['JELSZO'] ."</td>";
					
					
					echo " <td>" .$row['EMAIL'] ."</td>";
					
					echo " <td>" .$row['REG_IDOPONT'] ."</td>";
					
					echo " <td>" .$row['BANKSZAMLASZAM'] ."</td>";
					
					echo " <td>" .$row['EGYENLEG'] ."</td>";
					echo " <td>" .$row['IRANYITOSZAM'] ." ".$row['VAROS'] ." ".$row['UTCA'] ." ".$row['HAZSZAM'] ."</td>";
					
					
			
			echo "</tr>";
	}
	echo "</table>\n";
?>
