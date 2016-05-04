<?php 
	require_once('oracleconn.php');
	require_once('felhasznalomodosit.php');

	$selectstring = ("SELECT * FROM VASARLOK INNER JOIN IRANYITOSZAM
		ON VASARLOK.IRANYITOSZAM=IRANYITOSZAM.IRANYITOSZAM");
	$select = oci_parse($conn,$selectstring);
	oci_execute($select);
	echo "<table id='adminuser' class='table-center' border=\"1\">";
	$_SESSION['menu'] = "admin";
?>

<h1>Vásárlók adatai</h1>
<p>Ha a 'Küldés' gombra kattintunk és a felhasználó adatai módosultak, akkor az adatbázisban is módosítás történik.</p>
<p>Ha a 'Küldés' gombra kattintunk és nem történt módosítás, akkor töröljük a felhasználót az adatbázisból.</p>
<tr><th>Név</th><th>Email</th><th>Regisztrált</th><th>Számlaszám</th><th>Egyenleg (Ft)</th><th>Irszám</th><th>Város</th><th>Utca</th><th>Házszám</th><th>Tevékenység</th></tr>

<?php
	while ($row = oci_fetch_array($select, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>";
					echo "<form method=\"post\" action=\"felhasznalomodosit.php\">";
						echo "<td><input type=\"text\" name=\"nev\" size = \"10\"  value=\"".$row['NEV'] ."\"</td>";
						echo "<td><input class=\"dis-input\" type=\"text\" name=\"email\" size = \"20\" value=\"".$row['EMAIL'] ."\"</td>";
						echo " <td>" .$row['REG_IDOPONT'] ."</td>";
						echo "<td><input type=\"text\" name=\"banksz\" size = \"20\"  value=\"".$row['BANKSZAMLASZAM'] ."\"</td>";
						echo "<td><input type=\"text\" name=\"egyenleg\" size = \"10\"  value=\"".$row['EGYENLEG'] ."\"</td>";
						echo "<td><input type=\"text\" name=\"irszam\" size = \"5\"  value=\"".$row['IRANYITOSZAM'] ."\"</td>";
						echo " <td>" .$row['VAROS'] ."</td>";
						echo "<td><input type=\"text\" name=\"utca\" size = \"10\"  value=\"".$row['UTCA'] ."\"</td>";
						echo "<td><input type=\"text\" name=\"hszam\" size = \"5\"  value=\"".$row['HAZSZAM'] ."\"</td>";
						echo "<td class='text-center'><input type='submit' value='Módosítás/Törlés' name='kuld'/></td>";
					echo "</form>";
			echo "</tr>";
	}
	echo "</table>\n";
?>

<br/>
<?php 
	echo "<div class='text-center bal-doboz'>";
			rendelt_mennyiseg($conn);
	echo "</div>";
	echo "<div class='text-center jobb-doboz'>";
			fizetett_mennyiseg($conn);
	echo "</div>";
?>
<br/>

<form class="table-center" style="margin-bottom:20px" method="post" action="regel.php" >
	<fieldset id="adminf" class="table-center"> 
		<legend><b>Új vásárló felvétele</b></legend>
		
		<label for = "email">E-mail cím:</label>					
		<span id = "emails">
		<input type = "text" size="20" maxlength="40" name = "email" id = "email" />
		<span class="error"><?php echo @$_SESSION["emailErr"]; ?></span></span>
		<br/><br/>			
		<label for = "jel" id="jell">Jelszó:</label>					
		<span id = "jels">
		<input type = "password" size="20" name = "jel" id = "jel" />
		<span class="error"><?php echo @$_SESSION["jelErr"]; ?></span></span>
		<br/><br/>
		<label for = "jel2">Jelszó ismét:</label>					
		<span id = "jel2s">
		<input type = "password" size="20" name = "jel2" id = "jel2" />
		<span class="error"><?php echo @$_SESSION["jel2Err"]; ?></span></span>
		<br/><br/>
		<label for = "nev">Név:</label>
		<label for = "nev" id = "nevl">
		<span id = "nevs">			
		<input type = "text" size = "20"	maxlength = "30" name = "nev" id = "nev"  />
		<span class="error"><?php echo @$_SESSION["nevErr"]; ?></span></span> <!-- meg kell nézni mekkora lesz- az eltárolt sztring és miket kell eltárolni-->
		<br/><br/>
		<label for = "irszam">Irányító szám:</label>					
		<span id = "irszams">
		<input type = "text" size="4" name = "irszam" id = "irszam" />
		<span class="error"><?php echo @$_SESSION["irszamErr"]; ?></span></span>
		<br/><br/>
		<label for = "utca">Utca:</label>					
		<span id = "utcas">
		<input type = "text" size="20" maxlength="40" name = "utca" id = "utca" />
		<span class="error"><?php echo @$_SESSION["utcaErr"]; ?></span></span>
		<br/><br/>
		<label for = "hsz">Házszám:</label>					
		<span id = "hszs">
		<input type = "text" size="20" name = "hsz" id = "hsz" />
		<span class="error"><?php echo @$_SESSION["hszErr"]; ?></span></span>
		<br/><br/>
		<label for = "banksz">Bankszámlaszám (kötőjellel elválasztva):</label>					
		<span id = "bankszs">
		<input type = "text" size ="26 "maxlength = "26" name = "banksz" id = "banksz" />
		<span class="error"><?php echo @$_SESSION["bszErr"]; ?></span></span>
		<br/><br/>

		<input type="hidden" name="cel2" value="regel.php" />
		<input class="myButton" type="submit" name="submit" value="Felvétel" id="reg" />
		<p><?php echo @$_SESSION['felvetelsikeres'];?></p>
	</fieldset>			
</form>
