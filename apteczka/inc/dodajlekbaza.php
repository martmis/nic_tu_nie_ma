<?php 
	session_start();
	require_once "../conf/zmienne.php";
	require_once "$lang/error_msg.php";
	require_once "$lang/teksty.php";
	require_once "funkcje.php";
	
	require_once "nagl.php";
	require_once "menu.php";

	//Wprowadzenie leku do bazy
		
	//nazwa
	if(isset($_POST['nazwa']))
	{
		$wszystko_OK = TRUE;
		
		$nazwa = $_POST['nazwa'];
		
		//tylko małe litery
		$nazwa = strtolower($nazwa);
		//brak polskich znakow
		$nazwa = utf8_decode($nazwa);
		
		$ean = $_POST['ean'];	
		
		if(ctype_digit($ean)!=true)
		{
			$wszystko_OK = FALSE;
			$_SESSION['e_lek'] = $elek_ean_int;
		}
		$ean_length = strlen($ean);
		
		if($ean_length!=13)
		{	
			$wszystko_OK = FALSE;
			$_SESSION['e_lek'] = $elek_ean;
		}

		$jednostka = $_POST['jednostka'];
		
		$ilosc = $_POST['ilosc'];
		
		if(ctype_digit($ilosc)!=true)
		{
			$wszystko_OK = FALSE;
			$_SESSION['e_lek'] = $elek_ean_int;
		}
		
		$subst_czynna = $_POST['subst_czynna'];
		
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
				//czyl nazwa juz jest
				$rezultat =$baza->query("SELECT id_lek_specyfikacja FROM leki_specyfikacja WHERE nazwa='$nazwa'");
				
				if(!$rezultat) throw new Exception($baza->error);
				
				$liczba_lek = $rezultat->num_rows;
				
				if($liczba_lek>0)
				{
					$wszystko_OK = false;
					$_SESSION['e_lek'] = $elek_lek_instnieje;
				}
				
				//czyl ean juz jest
				$rezultat =$baza->query("SELECT id_lek_specyfikacja FROM leki_specyfikacja WHERE ean='$ean'");
				
				if(!$rezultat) throw new Exception($baza->error);
				
				$liczba_ean = $rezultat->num_rows;
				
				if($liczba_ean>0)
				{
					$wszystko_OK = false;
					$_SESSION['e_lek'] = $elek_lek_instnieje;
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($baza->query("INSERT INTO lek_specyfikacja VALUES (NULL, '$nazwa', '$ean', '$jednostka', '$ilosc', '$subst_czynna')"))
					{
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
	}
	
	
	
?>

<div class="container">
  <h2><?php echo $dodLekBaza?></h2>     
  <table class="table table-bordered" id=tabela>
    <thead>
      <tr>
        <th><?php echo $dodNazwa?></th>
        <th><?php echo $dodEan?></th>
        <th><?php echo $dodJednostka?></th>
        <th><?php echo $dodIlosc?></th>
		<th><?php echo $dodSubsCzynna?></th>        
      </tr>
	  <form method=POST>
		<tr>
			<div class="blacktext">
				<th><font color="black"><input type="text" name="nazwa" required></font></th>
				<th><font color="black"><input type="number" name="ean" required></font></th>
				<th><input type="radio" name="jednostka" value="tabletki"><?php echo $dodTabletki?></br>
				<input type="radio" name="jednostka" value="plyn"><?php echo $dodPlyn?></th>				
				<th><font color="black"><input type="number" name="ilosc" required></font></th>
				<th><font color="black"><input type="text"name="subst_czynna" required></font></th>
				
				<?php 
					if(isset($_SESSION['e_lek']))
					{
						echo '<div class="error">'.$_SESSION['e_lek'].'</div>';
						unset($_SESSION['e_lek']);
					}?> 
				
			</div>
		</tr></br>
    </thead>
  </table>
  </br></br>
  <div class ="" align="center">
	<button input type="submit" class="btn btn-loguj" align="center"><?php echo $dodLek?>
  </div></br>
</form>
</div>

<?php 
	require_once "stopka.php";
?>
