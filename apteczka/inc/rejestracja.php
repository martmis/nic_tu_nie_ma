<?php 

	session_start();
	
	require_once "../conf/zmienne.php";
	require_once "$lang/error_msg.php";
	require_once "$lang/teksty.php";
	require_once "funkcje.php";
	require_once "passwordLib.php";
	require_once "passwordLibClass.php";
	
	
	if(isset($_POST['email']))
	{
		//udana walidacja
		$wszystko_OK = true;
		
		//Sprawdzenie poprawnosci Nicka
		$nick = $_POST['nick'];
		
		//sprawdzenie długości  nicka
		if((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK = false;
			$_SESSION['e_nick'] = $erej_enick;
		}
		
		if(ctype_alnum($nick)==false)
		{
			$wszystko_OK =  flalse;
			$_SESSION['e_nick']=$erej_nick_znaki;
		}
		
		//Sprawdzenie poprawnosci maila
		$email = $_POST['email'];
		$email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($email_safe, FILTER_VALIDATE_EMAIL)==false)  ||  ($email_safe!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']= $erej_email;
		}
		
		//Sprawdzenie hasło
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']= $erej_haslo;
		}
		
		if($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']= $erej_haslo_inne;		
		}
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		if(!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']= $erej_regulamin;
		}			
		
		//BOT OR NOT - recaptcha
		$secretkey ="6LduDyATAAAAALg1es-YQPgssmz4RPgl_9WwhGLn";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkeyret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		//łączenie się z bazą - spr czy istnieje użytkonwik o podanym nick-u
		
		require_once "../conf/zmienne.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT); //rzucenie wyjątku
		
		try 
		{
			$baza = @new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);
			
			if($baza->connect_errno>0)
			{
				throw  new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $baza->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if(!$rezultat) throw new Exception($baza->error);
				
				$liczba_maili = $rezultat->num_rows;
				
				if($liczba_maili>0)
				{
					$wszystko_OK = false;
					$_SESSION['e_email'] = $erej_email_istnieje;
				}
				
				//Czy nick już istnieje?
				$rezultat = $baza->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
				
				if(!$rezultat) throw new Exception($baza->error);
				
				$liczba_nick = $rezultat->num_rows;
				
				if($liczba_nick>0)
				{
					$wszystko_OK = false;
					$_SESSION['e_nick'] = $erej_nick_istnieje;
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($baza->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, 14)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: glowna.php');
					}
					else
					{
						throw new Exception($baza->error);
					}	
				}

				$baza->close();
			}
		}
		catch (Exception $e)
		{
			echo  '<span style="color:red;">'.$e_serwer.'</span>';
			echo '<br/> Informacja  developerska: '.$e;  //tylko w fazie tworzenia  - wyrzucane bledy
		}
		
		if($odpowiedz->success==false)
		{
			$wszystko_OK = false;
			$_SESSION['e_bot'] = $erej_bot;
		}
			
	if(wszystko_OK==true)
	{
		
	}
	}
?>

<!DOCTYPE html>
<html lang='pl'>
<head>
	<title>Rodzinna apteczka</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type=text/css href="../style.css">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body id=tlo>
	<div class="site wrapper">
		<ul class="nav nav-pills">
				<object align="right"><a class="navbar-brand" href="index.php">
					<span class="glyphicon glyphicon-home"></span>
					<?php echo $tytul;?></a>
				</object></br>
		</ul>
	</div></br>
<div class="container" id=logowanie></br>
<form class="form-horizontal" method="POST">
	<H1 align="center"><?php echo $logRejestracja?></H1></br>
	</br>
	
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $lbNick;?></label>
			<div class="col-sm-10" id="input_text">	
				<input type="text" class="form-control" name="nick" placeholder="<?php echo $logNickpch;?>"requiered>
				
				<?php
					if(isset($_SESSION['e_nick']))
					{
						echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
						unset($_SESSION['e_nick']);
					}?>				
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $lbEmail;?></label>
			<div class="col-sm-10" id="input_text">	
				<input type="email" class="form-control" name="email" placeholder="<?php echo $logEmailpch;?>" requiered>
				
				<?php 
					if(isset($_SESSION['e_email']))
					{
						echo '<div class="error">'.$_SESSION['e_email'].'</div>';
						unset($_SESSION['e_email']);
					}?> 
			</div>	
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $lbHaslo;?></label>		
			<div class="col-sm-10" id="input_text">	
				<input type="password" class="form-control" name="haslo1" placeholder="<?php echo $logHaslopch;?>" required>
				
				<?php if(isset($_SESSION['e_haslo']))
					{
						echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
						unset($_SESSION['e_haslo']);
					}?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php	echo $lbPowtorzHaslo;?></label>
			<div class="col-sm-10" id="input_text">
				<input type="password" class="form-control" name="haslo2" placeholder="<?php echo $logHaslopch;?>" required>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="regulamin" /><?php echo $lbRegulamin;?>
					</label>
			
				<?php if(isset($_SESSION['e_regulamin']))
					{
						echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
						unset($_SESSION['e_regulamin']);
					}?></br>
					
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-offset-2 col-sm-10">
				<div class="g-recaptcha" data-sitekey="6LduDyATAAAAAPkdA8Uy62zZH15OGeQ2EtgiFvzU">
				</div></br>
				
				<?php if(isset($_SESSION['e_bot']))
					{
						echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
						unset($_SESSION['e_bot']);
					}?>
			</label>
		</div>
		
		<div class="form-group" align="center">
			<div class="col-sm-12">
				<button input type="submit" class="btn btn-loguj">
					<?php echo $logZarejestruj ;?>
					<span class="glyphicon glyphicon-ok"> 
					</span>
				</button></br></br> 	
			</div>
		</div>
	</form>			
</div>
<?php 
	require_once "stopka.php";
?>


