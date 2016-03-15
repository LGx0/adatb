<?php 
	session_start();
	if(isset($_GET['menu'])) $menu=$_GET['menu'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="hu">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" href="Kepek/icon2.png">
		<title>Webáruház</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="fejlec">
			<h1>Webáruház</h1>
		</div>
		
		<div id="tartalom">
			<div class="menu">
				<ul>
					<?php
					if(!isset($_GET['tartalom'])){
						echo "<li class='menupont myButton'><a href='index.php?tartalom=reg.php&menu=reg'>Regisztráció</a></li>";
					}else{
						switch($menu){
							case "admin":
								echo "
									<li class='menupont myButton'><a id='jelenlegi' href='index.php?tartalom=admintermekek.php&menu=admin'>Termékek</a></li>
									<li class='menupont myButton'><a href = 'index.php?tartalom=adminszallitasok.php&menu=admin'>Szállítások</a></li>
									<li class='menupont myButton'><a href = 'index.php?tartalom=adminszamlak.php&menu=admin'>Számlák</a></li>
									<li class='menupont myButton'><a href='index.php'>Kilépés</a></li>
									";
								break;
							case "reg":
								echo "
									<li class='menupont myButton'><a href='index.php'>Vissza</a></li>
									";
								break;
							case "fooldal":
								?>
									<li class='menupont myButton' ><a id='jelenlegi' href='index.php?tartalom=fooldal.php&menu=fooldal'>Főoldal</a></li>
									<li class='menupont myButton'><a href = 'index.php?tartalom=adatok.php&menu=fooldal'>Felhasználói adatok</a></li>
									<li class='menupont myButton'><a href = 'index.php?tartalom=termekek.php&menu=fooldal'>Termékek böngészése</a></li>
									<li class='menupont myButton'><a href ='index.php?tartalom=kosar.php&menu=fooldal'>Kosárban:<?php echo $_SESSION['kosarban']; ?></a></li>
									<li class='menupont myButton' ><a  href='kileptet.php'>Kilépés</a></li>
									<li  id ='azon'><?php echo $_SESSION['azon']; ?></li>
								<?php	
								break;
							case "adminuser":
								?><li class='menupont myButton' ><a  href='kileptet.php'>Kilépés</a></li><?php
								break;
						};
					}

					?>
					
				</ul>
			</div>
			<?php
				if(isset($_GET['tartalom'])){
					$_GET['menu']="tartalom";
					include($_GET['tartalom']);
				}else{
					
					include('tartalom.php');
				}
			?>
		</div>
		
		
		<div id ="lablec"></div>
	</body>
</html>