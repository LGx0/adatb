<?php

$conn = oci_connect('H047123', 'h047123', 'localhost/XE', 'AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	/*echo"nem";*/
}/*else{
echo "siker <br/>";
}*/

function felhasznalo_email_alapjan($connection, $email,$password)
{
$returnvalue = false;
$find = oci_parse($connection, "SELECT * FROM Vasarlok WHERE email = $email ");
oci_execute($find);

$values = oci_fetch_array($find, OCI_BOTH);
$returnvalue =!empty($values);
if ($returnvalue == false)
	{	@$_SESSION["emailError"] = "Nem létezik ilyen felhasználó";}
$pass = $values["JELSZO"];
	if(($password != $pass)&&($password != ""))
	{
	$returnvalue = false;
	@$_SESSION["jelError"] = "Hibás jelszó";
	}

//var_dump($returnvalue);
return $returnvalue;
}

function felhasznalo_neve($connection, $email){
	$name = null;
	$find = oci_parse($connection, "SELECT NEV FROM Vasarlok WHERE email = '$email' ");
	oci_execute($find);
	
	while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)){
		$name = $row['NEV'];
	}
	
	return $name;
}


function felhaszn_keres($connection, $email){
$returnvalue = false;
$find = oci_parse($connection, "SELECT * FROM Vasarlok WHERE email = $email ");
oci_execute($find);
$values = oci_fetch_array($find, OCI_BOTH);
$returnvalue =!empty($values);
if ($returnvalue == true)
	{	@$_SESSION["emailErr"] = "Ezzel az e-mail címmel már regisztráltak egyszer!";}
return $returnvalue;
}




function legnepszerubb($connection)
{
$select=("SELECT NEV, KATEGORIA, ELAD_AR,KOD FROM
(SELECT NEV, KATEGORIA,ELAD_AR,KOD  FROM TERMEKEK ORDER BY ELADOTT_MENNYISEG DESC)
WHERE ROWNUM <=5
ORDER BY KATEGORIA DESC");
$find = oci_parse($connection, $select);
oci_execute($find);

echo "<table class='table-center table-width' border='1'>\n";
?>
<tr><th>játék neve</th> <th> kategória</th> <th> ár </th> </tr>
<?php
while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)) {
		echo "<tr>\n";
					echo "<td><a target=\"_blank\" href =\"index.php?tartalom=termek.php&menu=fooldal&termekid=".$row['KOD']."\">" . $row['NEV'] . "</a></td>";
					echo "<td>" .$row['KATEGORIA'] ."</td>";
					echo " <td>" .$row['ELAD_AR'] ." Ft</td>";
				echo "</tr>\n";
}
echo "</table>\n";

}

function kategoriak($connection){
	$select =("SELECT DISTINCT KATEGORIA FROM TERMEKEK");
	$find = oci_parse($connection,$select);
	oci_execute($find);
	$counter = 0;
	while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)){
		foreach ($row as $kategoria){
			$counter++;
			echo "<div class='text-center ";if($counter % 2 == 0){ echo "jobb-doboz";}else{ echo "bal-doboz";}echo "'>";
				echo "<h2>" . $kategoria ."</h2>";
				$select2 =("SELECT NEV, ELAD_AR, KOD FROM 
				(SELECT *  FROM TERMEKEK WHERE KATEGORIA = '$kategoria' ORDER BY FELVETEL_DATUMA DESC )
				WHERE ROWNUM <=5");
				$find2 = oci_parse($connection,$select2);
				oci_execute($find2);
				echo "<table  class='table-center table-width' border='1'>\n";
				?><tr><th>játék neve</th> <th> ár </th> </tr><?php
				while ($row2 = oci_fetch_array($find2, OCI_ASSOC+OCI_RETURN_NULLS)) {
					echo "<tr>\n";
						echo "<td><a target=\"_blank\" href =\"index.php?tartalom=termek.php&menu=fooldal&termekid=".$row2['KOD']."\">" . $row2['NEV'] . "</a></td>";
						echo " <td>" .$row2['ELAD_AR'] ." Ft</td>";
					echo "</tr>\n";
				}
				echo "	</table>\n
			</div>\n
			";
		}
	}
}

function felhasznaloi_adatok($connection,$id)
{
	$selectuser =("SELECT * FROM VASARLOK WHERE EMAIL = '$id'");
	$find = oci_parse($connection, $selectuser);
	oci_execute($find);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)) {
	?>
	<form method="post" action="adatmodosit.php">
		<p>Email cím: <?php echo $row['EMAIL']; ?> </p>
		<p class="error"><?php echo @$_SESSION["emailErr2"]; ?></p>
		 <input type="hidden" name="jelsz" value="<?php echo $row['JELSZO'];?>"/>
		<p>Új jelszó: <input type="password" size="20" name="ujjelsz"/></p>
		<p class="error"><?php echo @$_SESSION["jelErr2"]; ?></p>
		<p>Új jelszó megerősítése: <input type="password" size="20" name="ujjelsz2"/></p>
		<p class="error"><?php echo @$_SESSION["jel2Err2"]; ?></p>
		<p>Bankszámlaszám: <input type="text" name="banksz"  size ="26 "maxlength = "26" value="<?php echo $row['BANKSZAMLASZAM'];?>"/></p>
		<p class="error"><?php echo @$_SESSION["bszErr2"]; ?></p>
		<p>Irányítószám: <input type="text" size="4" maxlength = "4" name="irsz" value="<?php echo $row['IRANYITOSZAM'];?>"/></p>
		<p class="error"><?php echo @$_SESSION["irszErr2"]; ?></p>
		<p>Utca: <input type="text" size="20" maxlength="40" name="utca" value="<?php echo $row['UTCA'];?>"/></p>
		<p class="error"><?php echo @$_SESSION["utcaErr2"]; ?></p>
		<p>Házszám: <input type="text" size="20" maxlength="20" name="hsz" value="<?php echo $row['HAZSZAM'];?>"/></p>
		<p class="error"><?php echo @$_SESSION["hszErr2"]; ?></p>
		<p>Egyenleg: <?php echo $row['EGYENLEG'];?> Ft </p>
		<input type="submit" value="Módosít" name="modosit" />
		<p class ="error"><?php echo @$_SESSION['sikeresmodositas'];?> </p>
	</form>
	<?php
	@$_SESSION['sikeresmodositas'] = "";
		
}

}

function vasarolt_termekek($connection,$email)
{
	$select =("SELECT TERMEKEK.NEV,  TERMEKEK.KATEGORIA, VASAROL.MENNYISEG,VASAROL.AR,  (VASAROL.AR*VASAROL.MENNYISEG) AS OSSZEG, VASARLASOK.FELVETEL, TERMEKEK.KOD
	FROM TERMEKEK
	INNER 
	JOIN VASAROL 
	ON TERMEKEK.KOD = VASAROL.TERMEK_KOD
	INNER 
	JOIN VASARLASOK 
	ON VASARLASOK.ID = VASAROL.VASARLAS_ID
	WHERE VASARLASOK.VASARLO_EMAIL = '$email'");
	$find = oci_parse($connection,$select);
	$countfind = oci_parse($connection,$select);
	oci_execute($countfind);
	oci_execute($find);
	
	$counter = 0;
	
	while ($countrow = oci_fetch_array($countfind, OCI_ASSOC+OCI_RETURN_NULLS)) {
		$counter++;
	}
	
	if($counter > 0){
		echo "<table border='1'>\n";
		echo "<tr> <th>Termék neve</th> <th>Kategória </th> <th>Vásárolt mennyiség</th>
				<th>Termék ára</th> <th>Összeg</th> <th>Vásárlás időpontja</th></tr>";
		while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)) {
				
				echo "<tr>";
					
					
						echo "<td><a target=\"_blank\" href =\"index.php?tartalom=termek.php&menu=fooldal&termekid=".$row['KOD']."\">" . $row['NEV'] . "</a></td>";
					
						echo "<td>" .$row['KATEGORIA'] ."</td>";
						
						
						echo " <td>" .$row['MENNYISEG'] ."</td>";
						
						echo " <td>" .$row['AR'] ."</td>";
						
						echo " <td>" .$row['OSSZEG'] ."</td>";
						
						echo " <td>" .$row['FELVETEL'] ."</td>";
				
				echo "</tr>";
		}
		echo "</table>\n";
	}else{
		echo "<p class=\"text-center\">Nincs megvásárolt terméke!</p> \n";
	}
}
/*
function kategoriadropdwon($connection){
	$select =("SELECT DISTINCT KATEGORIA FROM TERMEKEK");
	$find = oci_parse($connection,$select);
	oci_execute($find);
	?> <select name="kategoriak" > <?php
	while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)){
		foreach ($row as $kategoria){
		echo("<option value=\"  $kategoria  \"> $kategoria  </option>");	
		}
	}
	echo "</select>";

}

function kategoriakilistaz($connection,$category){
	$select =("SELECT nev,kategoria, elad_ar, kod FROM TERMEKEK WHERE KATEGORIA = '$category'");
	$find = oci_parse($connection,$select);
	oci_execute($find);
	echo "<table border='1'>\n";
	?> <caption><?php echo $category?>ok</caption>
	<tr><th>játék neve</th> <th> kategória</th> <th> ár </th> </tr><?php
	
	while ($row = oci_fetch_array($find, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>";
				
				
					echo "<td><a target=\"_blank\" href =\"index.php?tartalom=termek.php&menu=fooldal&termekid=".$row['KOD']."\">" . $row['NEV'] . "</a></td>";
				
					echo "<td>" .$row['KATEGORIA'] ."</td>";
					
					
					echo " <td>" .$row['ELAD_AR'] ."</td>";
			
			echo "</tr>";
	}
	echo "</table>\n";
	

}
*/
function egyenlegfeltolt($connection, $email,$osszeg)
{
	
	$update_osszeg_string = ("UPDATE VASARLOK SET EGYENLEG = EGYENLEG + $osszeg WHERE EMAIL = '$email' ");
	$update_osszeg = oci_parse($connection,$update_osszeg_string);
	oci_execute($update_osszeg);
	
}

function felhaszn_modosit($connection, $email, $jelszo,$banksz,$irsz,$utca,$hsz)
{
	$update_user_string=("UPDATE VASARLOK SET  
	JELSZO = '$jelszo', 
	BANKSZAMLASZAM = '$banksz',
	IRANYITOSZAM = '$irsz',
	UTCA = '$utca',
	HAZSZAM  = '$hsz'
	WHERE
	EMAIL = '$email' ");
	$update_user=oci_parse($connection,$update_user_string);
	$returnvalue =oci_execute($update_user);
	return $returnvalue;
}
function felhaszn_felvesz($connection,$email, $jelszo,$nev,$bszam,$irsz,$utca,$hsz)
{
	$insert_user_string=("INSERT INTO VASARLOK 
	(EMAIL, JELSZO, NEV, REG_IDOPONT, EGYENLEG, IRANYITOSZAM, UTCA, HAZSZAM, BANKSZAMLASZAM) 
	VALUES 
	('$email', '$jelszo', '$nev', SYSDATE, '0', '$irsz', '$utca', '$hsz', '$bszam')");
	$insert_user=oci_parse($connection,$insert_user_string);
	$returnvalue = oci_execute($insert_user);
	return $returnvalue;
}

function termek_megjelenit($connection,$termekkod)
{
	$select_termek_string=("SELECT * FROM TERMEKEK WHERE KOD = $termekkod");
	$select_termek =oci_parse($connection,$select_termek_string);
	oci_execute($select_termek);
	
	while ($row = oci_fetch_array($select_termek, OCI_ASSOC+OCI_RETURN_NULLS)) {
			
			?>
			<div id= "termek">
			<form method="post" action="kosarbarak.php">
			<p id="jateknev"> <?php 	echo $row['NEV']; ?> </p>
			<p id ="jatekkategoria">Kategória: <?php 	echo $row['KATEGORIA']; ?> </p>
			<p id ="ar"> Ár: <?php 	echo $row['ELAD_AR']; ?> Ft </p>
			<input type="hidden" value="<?php echo $row['KOD']; ?> " name="termekkod"/>
			<p id="darab">
			Vásárolni kívánt mennyiség:<input type="number" value="1" name="mennyiseg"/>
			<input type="submit" value="Kosárba" name="kosarba" />
			</form>
			</p>			
			<b><p>Akik ezt a terméket vásárolták, ez(eke)t is megvették:</p></b>
			 <?php
			
			kapcsolódó_termék($connection,$row['KOD']);?>
			
			</div>
			<?php
			
			
	}
}

function kapcsolódó_termék($connection,$termekkod){
	
	$select_kapcs_termek_string=("SELECT DISTINCT TERMEKEK.NEV, TERMEKEK.KOD, TERMEKEK.KATEGORIA, TERMEKEK.ELAD_AR
			FROM TERMEKEK
			INNER 
			JOIN VASAROL 
			ON TERMEKEK.KOD = VASAROL.TERMEK_KOD
			INNER 
			JOIN VASARLASOK 
			ON VASARLASOK.ID = VASAROL.VASARLAS_ID
			WHERE VASARLASOK.VASARLO_EMAIL IN 
			(
			SELECT VASARLASOK.VASARLO_EMAIL FROM VASAROL
			INNER 
			JOIN VASARLASOK 
			ON VASAROL.VASARLAS_ID = VASARLASOK.ID 
			WHERE VASAROL.TERMEK_KOD = $termekkod )
			AND TERMEKEK.KOD != $termekkod" );
	$select_kapcs_termek= oci_parse($connection,$select_kapcs_termek_string);
	oci_execute($select_kapcs_termek);
	
	while ($row = oci_fetch_array($select_kapcs_termek, OCI_ASSOC+OCI_RETURN_NULLS)) {			
			echo "<p class =\"link myButton\"><a target=\"_blank\" href =\"index.php?tartalom=termek.php&menu=fooldal&termekid=".$row['KOD']."\"><span style='float:left;width:89%'>" . $row['NEV'] .", ".$row['KATEGORIA']. "</span><span style='float:right;'>".$row['ELAD_AR']." Ft</span></a></p>";
	}
	

}

function vasarolni_kivant_termekek($connection,$termekkod,$mennyiseg){
		
		$select_termek_string=("SELECT * FROM TERMEKEK WHERE KOD = $termekkod");
		$select_termek =oci_parse($connection,$select_termek_string);
		oci_execute($select_termek);
		
		
		
	while ($row = oci_fetch_array($select_termek, OCI_ASSOC+OCI_RETURN_NULLS)) {
				?> <form method="post" action="kosarboltorol.php"> <?php
				$_SESSION['vegosszeg'] += ($mennyiseg * $row['ELAD_AR']);
				
				echo "<tr>\n";
						echo "<td>" . $row['NEV'] . "</td>";
						echo "<td>" . $row['KATEGORIA'] ."</td>";
						echo " <td>" . $row['ELAD_AR'] ." Ft</td>";
						echo " <td>" . $mennyiseg ."</td>";
						echo " <td>" . ($mennyiseg * $row['ELAD_AR']) ."  Ft</td>";
						echo"<input type=\"hidden\" value=\"".$row['KOD']."\" name=\"termekkod\"/>";
						echo"<input type=\"hidden\" value=\"".$mennyiseg."\" name=\"mennyiseg\"/>";
						echo " <td class=\"text-center\"> <input type=\"submit\" value=\"Töröl\" name=\"töröl\"></td>";
					echo "</tr> </form>";
				
	}


	
}

function megvasarol($connection,$email){
	
	
	
	$insert_vasarlasok_string=("INSERT INTO VASARLASOK (VASARLO_EMAIL, FELVETEL)
	VALUES ('$email',SYSDATE)");
	$insert_vasarlasok=oci_parse($connection,$insert_vasarlasok_string);
	if(!(oci_execute($insert_vasarlasok)))
	{ 
	echo "A beszúrás nem történt meg  a VASARLASOK táblába!";
	}
	
	$insert_szallitasok_string=("INSERT INTO SZALLITASOK ( ESEDEKESSEG) 
	VALUES	( SYSDATE + 5 )");
	$insert_szallitasok=oci_parse($connection,$insert_szallitasok_string);
	if(!(oci_execute($insert_szallitasok)))
	{ 
	echo "A beszúrás nem történt meg  a SZALLITASOK táblába!";
	}
	
	foreach( @$_SESSION['kosar'] as $termekkod => $mennyiseg)
		{	
			
			$select_ar_string=("SELECT ELAD_AR FROM TERMEKEK WHERE KOD = '$termekkod'");
			$select_ar =oci_parse($connection,$select_ar_string);
			oci_execute($select_ar);
			$row = oci_fetch_array($select_ar, OCI_ASSOC+OCI_RETURN_NULLS);
			$ar = $row['ELAD_AR'];

			$insert_vasarol_string=("INSERT INTO VASAROL (TERMEK_KOD, AR, MENNYISEG)
			VALUES ('$termekkod','$ar','$mennyiseg')");
			$insert_vasarol=oci_parse($connection,$insert_vasarol_string);
			if(!(oci_execute($insert_vasarol)))
			{ 
			echo "A beszúrás nem történt meg  a VASAROL táblába!";
			}
			
			$update_eladott_mennyiseg_string =("UPDATE TERMEKEK SET ELADOTT_MENNYISEG  = ELADOTT_MENNYISEG + '$mennyiseg' WHERE KOD = '$termekkod' " );
			$update_eladott_mennyiseg =oci_parse($connection,$update_eladott_mennyiseg_string);
			oci_execute($update_eladott_mennyiseg);
						
			
		} 
	
	
}

function mennyipenzevan($connection,$email){
	$select_vasarlo_egyenlege_string=("SELECT EGYENLEG FROM VASARLOK WHERE EMAIL='$email'");
	$select_vasarlo_egyenlege=oci_parse($connection,$select_vasarlo_egyenlege_string);
	oci_execute($select_vasarlo_egyenlege);
	$egyenleg = oci_fetch_array($select_vasarlo_egyenlege, OCI_ASSOC+OCI_RETURN_NULLS);
	return $egyenleg['EGYENLEG'];
	
}

function vasarlo_egyenleg_csokk($connection,$email,$osszeg){
	$update_vasarlo_egyenlege_string=("UPDATE VASARLOK SET EGYENLEG = EGYENLEG - '$osszeg' WHERE EMAIL='$email'");
	$update_vasarlo_egyenlege=oci_parse($connection,$update_vasarlo_egyenlege_string);
	oci_execute($update_vasarlo_egyenlege);
	
}





?>