<?php
	
	session_start();
	
	if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true)
	{
		header('Location: gra.php');
		exit(); // zeby od razu wyjsc z kodu - > i przejsc do pliku gra.php
		// gdy uzytkonwik jest juz zalogowany	
	}
	
?>

<!DOCTYPE HTML>
<html lang='pl'>
<head>
	<title>Piekarnia</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>	
	<title>Osadnicy-gra</title>
</head>

<body>
			Tylko martwi ujrzeli koniec wojny
		
		<form action="zaloguj.php" method="post">
			Login: <br/> <input type="text" name="login"/> <br/>
			Hasło: <br><input type="password" name="haslo"/> <br/>
			<input type="submit" value="Zaloguj się"/>
		</form>

<?php

	if(isset($_SESSION['blad']))		
		echo $_SESSION['blad'];
	
?>		
		
</body>
</html>
