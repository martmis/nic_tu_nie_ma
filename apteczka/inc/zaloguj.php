<?php 

session_start();
//po załadanowaniu zmiennych:

//$dbServer, $dbLogin, $dbHaslo, $dbBaza

require_once "../conf/zmienne.php";
require_once "passwordLib.php";

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
	header('Location:index.php');
	exit();
}
	
$baza = @new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

//spr czy jest połączenie
if($baza->connect_errno>0)
{
	die("Nie można połączyć się z bazą ['. $db->connect_error .']");
	//echo "Error: ".$baza->connect_errno."Opis: ".$baza->connect_errorl;
}
else 
{
	$login  = $_POST['login'];
	$haslo = $_POST['haslo'];
	
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
	if($rezultat = @$baza->query(
	sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
	mysqli_real_escape_string($baza, $login)))) //zapytanie do bazy
	{
		$ilu_userow=$rezultat->num_rows;
		if($ilu_userow>0)
		{				
			$wiersz = $rezultat->fetch_assoc();
			
			if(password_verify($haslo, $wiersz['pass']))
			{
				$_SESSION['zalogowany'] = true;
				$_SESSION['id'] = $wiersz['id']; 
				$_SESSION['user'] = $wiersz['user'];
				
				unset ($_SESSION['blad']);
				$rezultat->free_result();			
				header('Location:glowna.php');
			}
			else  
			{
				$_SESSION['blad'] = 'Blad logowania'; //!!!!!!!!!!!!!!!!!!!!!!!!!!!!	zmien na zmienna 
				header('Location:index.php');
			}
		} 
		else  
		{
				$_SESSION['blad'] = 'Blad logowania'; //!!!!!!!!!!!!!!!!!!!!!!!!!!!!	zmien na zmienna 
				header('Location:index.php');
		}
	}	
	else
	
//ustawienie właściwego kodowania
//$baza->set_charset('utf8');

$baza->close();
}
?>

