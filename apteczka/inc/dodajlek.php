<?php 
	session_start();
	require_once "../conf/zmienne.php";
	require_once "$lang/error_msg.php";
	require_once "$lang/teksty.php";
	require_once "funkcje.php";
	
	require_once "nagl.php";
	require_once "menu.php";
	
?>

</br>
<div class = "blacktext">
	<div class ="col-sm-12" align="center">
		<a href="dodajlekbaza.php">
			<button class="btn btn-loguj"><?php echo $dodLekBaza?></button>
		</a>
	 </div></br></br></br>
	  
	<div class ="col-sm-12" align="center">
		<a href="dodajlekapteczka.php">
			<button class="btn btn-loguj"><?php echo $dodLekApteczka?></button>
		</a>
	  </div></br></br>
</div>
</br>
<?php 
	require_once "stopka.php";
?>