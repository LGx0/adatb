﻿<?php 
require_once('oracleconn.php'); 

if(!(isset($_SESSION['azon'])))
{
header ('Location: index.php');
}
$_SESSION['menu'] = "fooldal";
?>
	<div class="text-center" style="margin-bottom:20px;">
		<h2> Új termékeink </h2>
		<?php kategoriak($conn); ?>
		<div class="clear"></div>
	</div>
	
	<div class="text-center clear" style="margin:20px 0;">
		<h2> Legnépszerűbb termékeink </h2>
		<?php legnepszerubb($conn); ?>
		<div class="clear"></div>
	</div>


