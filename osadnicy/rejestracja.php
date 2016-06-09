<?php

	session_start();
	
	if(isset($_POST['email']))
	{
		//Udana walidacja? Zakładamy że tak
		$wszystko_ok = true; // flaga walidacji
		
		//Spr poprawności nicka
		$nick = $_POST['nick'];
		
		//pobranie łańcucha
		if (strlen($nick) <3 || strlen($nick)>20)
		{
			$wszystko_ok = false;
			$_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków";
			
		}
		
		//spr czy znaki sa alfanumeryczne
		if(ctype_alnum($nick)==false)
		{
			$wszystko_ok = false;
			$_SESSION['e_nick'] = "Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//spr poprawnosc maila
		$email = $_POST['email'];
		$email_b = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($email_b, FILTER_VALIDATE_EMAIL)==false) || ($email_b != $email))
		{
			$wszystko_ok =false;
			$_SESSION['e_email'] = "Podaj poprawny adres email";
		}
		
		
		//spr popwanosc hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 =$_POST['haslo2'];	
		
		if(strlen($haslo1)<8 || strlen($haslo1)>20)
		{
			$wszystko_ok =false;
			$_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków";
		}
		
		if($haslo1!=$haslo2)
		{
			$wszystko_ok = false;
			$_SESSION['e_haslo'] = "Podane hasła nie są identyczne";
		}
		
		
		if($wszystko_ok==true)
		{
			//hura wszystko zaliczone, gracz dodany
			echo "Udana walidacja";
			exit();
		}
	}
	
?>

<!DOCTYPE HTML>
<html lang='pl'>
<head>
	<title>Piekarnia</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>	
	<title>Osadnicy-załóż darmowe konto</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<style>
		.error 
		{
			color:red;
			margin-top: 10px;
			margin-bottom:10px;
		}
	</style>
	
</head>

<body>
	
	<form method = "post">
	
	Nickname : </br> <input type="text" name="nick" /> </br>
	
	<?php
		if(isset($_SESSION['e_nick']))
		{
			echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
			unset($_SESSION['e_nick']);
		}
	?>
	
	E-mail : </br><input type="text" name="email" /> </br>
	
	<?php
		if(isset($_SESSION['e_email']))
		{
			echo '<div class = "error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
	?>
	
	Twoje hasło : </br><input type="password" name="haslo1"/> </br>
	
	<?php
		
		if(isset($_SESSION['e_haslo']))
		{
			echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
		}
	?>
	
	Powtórz hasło : </br><input type="password" name="haslo2"></br>
	
	<label>
		<input type="checkbox" name="regulamin" /> Akcpetuje regiulamin 
	</label>
	
	<div class="g-recaptcha" data-sitekey="6Lfudh0TAAAAAIb5rB6p-IxQvOpZX0eqO25qMjiJ"></div>
	
	</br>
	
	<input type="submit" value="Zarejestruj się"/>
	
	</form>
		
</body>
</html>
