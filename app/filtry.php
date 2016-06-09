
<?php
if(isset($_POST['imie']))
{			
	/*
		SELECT * FROM pacjenci AS p, badania AS b WHERE
		sprawdzaj obecność danych zmiennych, jeśli istnieją to przepisz je na zmienne pomocnicze i konkatenuj query
		utworzone query wyślij do wyciągania i powinno działać 
		1) wyszukiwanie po imieniu dodaj p.imie=$imie
		2) wyszukiwanie po nazwisku dodaj p.nazwisko=$nazwisko
		3) po peselu dodaj p.pesel=$pesel 
		4) po typie badania dodaj b.typ=$typBadania
		5) po dacie badania dodaj b.data=$dataBadania
		AND p.id_pacjenta=b.id_pacjenta
		Wszystko wyświetlone  przy pomocy echo, można przepisać na jednąwielką zmienną i wysyłać poprzes sesje lub post
	*/
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
	
	
	require_once "uploadConfig.php";
	$pierwszy=true;  //zmienna pomagająca w dodawaniu AND, jesli false to dodajemy do guery AND w kolejnym przypadku
	$sql_query="SELECT * FROM badania AS b, pacjenci AS p WHERE";
	
	if(isset($_POST['zFiltrami']))
	{	
		if($_POST['imie'])
		{
			$imie=$_POST['imie'];
			$sql_query=$sql_query.' p.imie="'.$imie.'"';
			//echo $sql_query."<br>";
			$pierwszy=false; 
		}	
		
		if($_POST['nazwisko']) 
		{
			if($pierwszy==false)
			{
				$sql_query=$sql_query." AND";
			}
			$nazwisko=$_POST['nazwisko'];
			$sql_query=$sql_query.' p.nazwisko="'.$nazwisko.'"';
			$pierwszy=false; 
			//echo $sql_query."<br>";
		}	
		
		if($_POST['pesel'])
		{
			if($pierwszy==false)
			{
				$sql_query=$sql_query." AND";
			}
			$pesel=$_POST['pesel'];
			$sql_query=$sql_query.' p.pesel="'.$pesel.'"';
			$pierwszy=false; 
			//echo $sql_query."<br>";
		}	
		
		if($_POST['typBadania'])
		{
			if($pierwszy==false)
			{
				$sql_query=$sql_query." AND";
			}
			$typBadania=$_POST['typBadania'];
			$sql_query=$sql_query.' b.typ="'.$typBadania.'"';
			$pierwszy=false; 
			//echo $sql_query."<br>";
		}	
		
		if($_POST['dataBadania'])
		{
			if($pierwszy==false)
			{
				$sql_query=$sql_query." AND";
			}
			$dataBadania=$_POST['dataBadania'];
			$sql_query=$sql_query.' b.data="'.$dataBadania.'"';
			$pierwszy=false; 
			//echo $sql_query."<br>";
		}
		$sql_query=$sql_query.' AND p.id_pacjenta=b.id_pacjenta';
		if($sql_query=="SELECT * FROM badania AS b, pacjenci AS p WHERE AND p.id_pacjenta=b.id_pacjenta")
		{
			echo "Nie wybrano żanych parematrów wyszukiwania!";
			exit();
		}
	}	
	
	if(isset($_POST['bezFiltrow']))
	{
		$sql_query=$sql_query." p.id_pacjenta=b.id_pacjenta";
	}
	//echo $sql_query."<br>";
	
		//łączenie z bazą danych i wstawianie rekordu do tabeli z rekordami dla odpowiedniego pacjenta
		mysqli_report(MYSQLI_REPORT_STRICT);		
		try 
		{
			$connection = new mysqli($host,$db_user,$db_password,$db_name);
			if($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else //poszukujemy plików o nazwach odpowiadających jeśli nie ma nic zgodnego to zmienna jako błąd i przerwij 
			{
				if ($sql_answer = @$connection->query($sql_query)) 
				{	
					$match = $sql_answer->num_rows;
					if($match>0) //jeśli znaleziono co najmniej jeden rekord
					{
						while ($row = $sql_answer-> fetch_assoc()) 
						{	
							$dir = dir($target); //zmienna wstazująca miejsce odczytu -> link do servera i folderu na nim
							while($file = $dir->read())
							{	
								if($file != '.' && $file != '..') 
								{
									if($row['data_file']==$file) //jeśli nazwa pliku wczytana z tablicy asocjacyjnej jest taka sama co pliku na serw to break
									{
										$location='<a href="data/'.$file.'"'.">".$file."</a>";  //link do przepisania na zmienną jakby coś z nią było robić
										//wypisanie całości danych -> można z tego zrobić tabelę, ale to kwestia stylu i wrzucenia divów
										echo "Imię: ".$row['imie']."</br>";
										echo "Nazwisko: ".$row['nazwisko']."</br>";
										echo "Pesel: ".$row['pesel']."</br>";
										echo "Płeć: ".$row['plec']."</br>";
										echo "Data: ".$row['data']."</br>";
										echo "Typ badania: ". $row['typ']."</br>";
										echo "Pobierz plik: ".$location."</br></br></br>";
										break;
									}
								}
							}
						}
						$dir->close();		//zamykanie rejestru z plikami
						$sql_answer->free_result(); //czyszczenie wyniku
						$connection->close(); //zamykanie połączenia z bazą
					}
					else
					{
						echo "Nie znaleziono zadnych pasujących rekordów, spróbuj innych parametrów wyszukiwania";
					}	
				}
				else
				{
					throw new Exception($connection->error);
				}
			}
		} 
		catch (Exception $e) 
		{
			echo '<div class="error">"Błąd serwera"</div>';
			echo $e."<br/>";
		}	
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$_SESSION['total_time'] = round(($finish - $start), 4);
}	
?>

