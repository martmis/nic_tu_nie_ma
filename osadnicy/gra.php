<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location:zaloguj.php');
		exit();
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

<?php
	
	echo "<p>Witaj: ".$_SESSION['user']."!";
	echo '[<a href  = "logout.php">Wyloguj się!</a>]</p>';
	echo "<p><b>Drewno: </b>".$_SESSION['drewno'];
	echo "<b> Kamień: </b>".$_SESSION['kamien'];
	echo "<b> Zboże: </b>".$_SESSION['zboze']."</p>";
	echo "<p><b>Email: ".$_SESSION['email']."</p>";
	echo "<p><b>Dni premium: ".$_SESSION['dnipremium']."</p>";
?>
			
		
</body>
</html>