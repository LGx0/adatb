<?php 
	require_once('oracleconn.php'); 

	if (!(isset($_POST['rendezes'])))
	{
		$rendezes = "ELADOTT_MENNYISEG";
	}else{
		$rendezes = trim( @$_POST['rendezes']);
	}
	$_SESSION['menu'] = "admin";
?>
<div id="termekadatok">
	<p>Rendezés alapja:</p>
	<form method="post" action="index.php?tartalom=admintermekek.php&menu=admin">
		<select name ="rendezes">
		  <option value="NEV">Név</option>
		  <option value="KOD">Termékkód</option>
		  <option value="KATEGORIA">Kategória</option>
		  <option value="BESZ_AR">Beszerzési ár</option>
		  <option value="ELAD_AR">Eladási ár</option>
		  <option value="ELADOTT_MENNYISEG">Eladott mennyiség</option>
		  <option value="ELADOTT_MENNYISEG">Felvétel dátuma</option>
		</select>
		<input type="submit" value="Rendez!" name="rendez"/>
	</form>
	<?php
		$selectstring = ("SELECT * FROM TERMEKEK ORDER BY $rendezes DESC");
		$select = oci_parse($conn,$selectstring);
		oci_execute($select);
		echo "<table class=\"table-center\" border=\1\">";
		?>
		<tr><th>Név</th><th>Temékkód</th><th>Kategória</th><th>Beszerzési ár</th>
		<th>Eladási ár</th><th>Eladott mennyiség(db)</th><th>Felvétel dátuma</th><th>Módosítás</th></tr>
		<?php
		while ($row = oci_fetch_array($select, OCI_ASSOC+OCI_RETURN_NULLS)) {
				echo "<tr>";
						?><form method="post" action="termekmodosit.php"><?php			
						echo "<td><input type=\"text\" name=\"nev\" size = \"25\"  value=\"".$row['NEV'] ."\"</td>";
						
					
						echo "<td><input type=\"text\" name=\"termekkod\" size = \"10\" disabled value=\"".$row['KOD'] ."\"</td>";
						echo "<input type=\"hidden\" name=\"kod\"  value=\"".$row['KOD'] ."\"/>";
						
						
						echo "<td><input type=\"text\" name=\"kategoria\" size = \"10\" disabled value=\"".$row['KATEGORIA'] ."\"</td>";
					
						echo "<td><input type=\"text\" name=\"beszar\" size = \"10\" value=\"".$row['BESZ_AR'] ."\"</td>";
					
						
						echo "<td><input type=\"text\" name=\"eladar\" size = \"10\" value=\"".$row['ELAD_AR'] ."\"</td>";
						
						echo "<td><input type=\"text\" name=\"eladott\" disabled size = \"20\" value=\"".$row['ELADOTT_MENNYISEG'] ."\"</td>";
						echo "<td><input type=\"text\" name=\"datum\" disabled size = \"10\" value=\"".$row['FELVETEL_DATUMA'] ."\"</td>";
					
						
						?>
						<td class="text-center"><input type="submit" value="Módosít" name="modosit"/></td>
						<?php
						
						
				
				echo "</tr></form>";
		}
		echo "</table>\n";
		?>
		
</div>
<div id ="termekfelvetel">
<fieldset class="admin-termek"> 
	<legend><b>Új termék felvétele</b></legend>
	<form method="post" action="ujtermek.php">
		<p>Név: <input type="text" name="nev"/></p>
		<p>Kategótia: <input type="text" name="kategoria"/></p>
		<p>Beszerzési ár: <input type="text" name="beszar"/></p>
		<p>Eladási ár: <input type="text" name="eladar"/></p>
		<p><input type="submit" name="submit" value="Mentés"/></p>
	</form>
</fieldset>
</div>

