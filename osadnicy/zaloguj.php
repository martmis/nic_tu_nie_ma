<?php
	
	session_start();
	
	if(!isset($_POST['login']) || !isset($_POST['haslo']) )
	{
		header("Location: index.php");
		exit();
	}
	require_once  "connect.php";
	
	//po≥πczenie z bazπ
	//@- wyciszamy raport o bledach z php zeby nie wyswitlaly sie na ekranie, bo sami oblsugujemy bledy, 
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	// spr czy jest polaczenie
	if($polaczenie->connect_errno != 0)
	{
		echo "Echo: ".$polaczenie->connect_errno;
	}
	else 
	{
		$login = $_POST[login];
		$haslo = $_POST[haslo];
		
		$login =htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo =htmlentities($haslo, ENT_QUOTES, "UTF-8");

		
		if($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s' ", 
		mysqli_real_escape_string($polaczenie, $login),
		mysqli_real_escape_string($polaczenie, $haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if ($ilu_userow>0)
			{	
				/*wsadzamy do zmiennej wiersz cala linijke danych dla jednego usera
				fetch_assoc funckja pozwala odnosic sie do pol tablicy przez nazwe kolumny a nie miejsce 0,1,..
				tablica ze slownym indeksem*/
				$_SESSION['zalogowany'] = true;
				$wiersz=$rezultat->fetch_assoc();
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['user'] = $wiersz['user'];
				$_SESSION['drewno'] = $wiersz['drewno'];
				$_SESSION['kamien'] = $wiersz['kamien'];
				$_SESSION['zboze'] = $wiersz['zboze'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['dnipremium'] = $wiersz['dnipremium'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				
				header('Location: gra.php');
			}
			else 
			{
				$_SESSION['blad'] = '<span style ="color:red">Nieprawid≈Çowy login lub has≈Ço</span>';
				header('Location: index.php');	
			}
		}
	
		
		
		$polaczenie->close();
	}

	
		
	
?>