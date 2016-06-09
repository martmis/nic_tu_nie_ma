<?php
	include("nagl.php");
	
	//Wa¿ne przy pierwszym uruchomieniu
	if(!isset($_POST['czynn1']) && !isset($_POST['czynn2'])){
		$czynn1=0;
		$czynn2=0;
	}else {
		$czynn1=$_POST['czynn1'];
		$czynn2=$_POST['czynn2'];
	}
	
	echo "<H2>Kalkulator</H2><p>"
?>
	<form action="p08.php" method="post">
		<input type="text" name="czynn1" value="<?echo $czynn1?>" size="5" maxlength="10"> x
		<input type "text" name="czynn2" value="<?echo $czynn2?>" size="5" maxlength="10">
	<input type="submit" value=" = " />
<? echo $czynn1 * $czynn2; ?>
</form>

<?
	echo "</p";
	include("stopka.php");
?>