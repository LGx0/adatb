<form method="post" action="regel.php" >
	<fieldset id="f1"> 
		<legend><b>Regisztrációhoz szükséges adatok</b></legend>
		
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
		<input class="myButton" type="submit" name="submit" value="Regisztráció" id="reg" />
		<p><?php echo @$_SESSION['felvetelsikeres'];?></p>
	</fieldset>			
</form>