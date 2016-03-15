<?php
	$_SESSION['menu'] = "tartalom";
?>
<div class="belepes_doboz">
	<form method="post" action="belepes.php">
		<fieldset id="f1">
			<legend><b>Bejelentkezési adatok</b></legend>
			<label for = "email" id = "emaill">E-mail:</label>
			<div id = "emails">			
				<input type = "text" size = "20" maxlength = "30" name = "email" id = "email" required />
				<span class="error"><?php echo @$_SESSION["emailError"] ?></span>
			</div>
			<br/>
			<label for = "jel" id="jell">Jelszó:</label>					
			<div id = "jels">
				<input type = "password" name = "jel" id = "jel" required/>
				<span class="error"><?php echo @$_SESSION["jelError"] ?></span>
			</div>
			<br/>
			<input class="myButton" type="submit" name="submit" value="Belépés" id="belepes" />
		</fieldset>
	</form>
</div>
<div class="login_kep">
	<img src="Kepek/games.png" alt="logo" align=right>
</div>