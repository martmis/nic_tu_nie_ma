<?php

session_start();

if(!isset($_SESSION['udanarejestracja']))
{
	header('Location:index.php');
	exit();
}
else 
{
	unset($_SESSION['udanarejestracja']);
}

require_once "../conf/zmienne.php";
require_once "$lang/error_msg.php";
require_once "$lang/teksty.php";
require_once "funkcje.php";
require_once "nagl.php";
?>
 
<a><?php echo $logPowitanie;?> </a>
<a href="index.php"><?php echo $logZalogujWitamy;?></a>



require_once "stopka.php";



?>