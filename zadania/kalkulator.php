<?php
	include("nagl.php");
	
	//Ważne przy pierwszym uruchomieniu
	if(!isset($_POST['czynn1']) && !isset($_POST['czynn2'])){
		$czynn1=0;
		$czynn2=0;
	}else {
		$czynn1=$_POST['czynn1'];
		$czynn2=$_POST['czynn2'];
	}
	
	echo "<H2>Kalkulator</H2><p>";
?>
	<form action = "" method="POST">
		<input type="text" name="czynn1" value="<?echo $czynn1?>" size="5" maxlength="10"> 
		<select name = "znak">
			<option>Wybierz działanie</option>
			<option value="dod">+</option>
			<option value="odej">-</option>
			<option value="dziel">/</option>
			<option value="mnoz">*</option>
		</select>
		<input type "text" name="czynn2" value="<?echo $czynn2?>" size="5" maxlength="10">
	<input type="submit" value=" = " />
	</form>
	
<?php
	$znak=$_POST['znak'];
	switch ($znak){
		case "dod":
			$wynik = $czynn1 + $czynn2;
		break;
		case "odej";
			$wynik = $czynn1 - $czynn2;
		break;
		case "dziel":
			if($czynn2==0){
				echo "Błąd w dzieleniu. Podaj poprawną wartość";
			}
			else {$wynik = $czynn1 / $czynn2;}
		break;
		case "mnoz":
			$wynik = $czynn1 * $czynn2;
		break;
		}
	echo $wynik;
?>
<?php
	echo "</p";
	include("stopka.php");
?>