<?php
	require_once "header.php";	
?>

<div class="container-fluid" id = "parentContainer" >
  <div class="row content" id = "rowContent">
    <div class="col-sm-3 sidenav hidden-xs">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php" onclick="ChangeBack()">Home</a></li>
        <li  class = "active"><a href="upload.php">Upload</a></li>
        <li><a href="records.php">Records</a></li>
      </ul><br>
    </div>
    <br>
    <div class="container-fluid col-sm-9">
      <div class="well" id = "mainContainer">
	  
<?	

	session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<html>
	<head>
		<meta charset="utf-8" />
	</head>
<body>

<?php
//czas jest mierzony od momentu otwarcia skryptu wrzucającego pliki na server do potwierdzenia 
//że plik znalazł się na serwerze a rekord został wpisany do bazy 
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;


//na tej stronie wyląduje użytkownik tylko gdy coś pójdzie nie tak , metoda dowadania tak plików 
//wymaga aby miały niepowtzrzajce sie nazwy, inaczej pliki się nadpiszą
//Rozmiar pliku, lokalizacja i dane do łączenia z bazą danych
require_once "uploadConfig.php";
$status=true;
$filesArr = isset($_FILES['plik'])? $_FILES['plik'] : array();
 
if (isset($filesArr['name']))
{ 
  foreach ($filesArr['name'] as $index=>$fileName)
  {
	//wysyłanie pliku na serwer
	if (is_uploaded_file($filesArr['tmp_name'][$index])) 
	{
		if ($filesArr['tmp_name'][$index] > $max_rozmiar) 
		{
			echo 'Błąd! Plik jest za duży!';
			$status=false;
		} 
		else 
		{
			echo '<br><br>Odebrano plik. <br> Nazwa: <b>'.$fileName.'</b><br>';
			$target = 'data';
			//$tmp_name =  $filesArr['tmp_name'][$index];
			$file_name = $fileName;
			move_uploaded_file($filesArr['tmp_name'][$index], $target."/".$fileName);
			// nazwa pliku jest potrzebna do utworzenia linku z lokalizacją na serwerze będzie przechowywana w bazie danych
			$status=true;
		}
	} 
	else 
	{
		echo 'Błąd przy przesyłaniu danych!';
		$status=false;
	}	

	$my_file = "$target/$file_name";
	$_SESSION['file_name']= $file_name;

	//pobieranie wartości z pól formularza 
	$file = fopen ($my_file, "r") or die("Unable to open file!");	
	$line = fgets ($file);		
	list ($pesel, $examine_name, $firstname, $surname) = explode ("," ,$line);		
	//echo $pesel.$examine_name.$firstname.$surname."<br>";
	$pesel=trim($pesel);
	$examine_name=trim($examine_name);
	$firstname=trim($firstname);
	$surname=trim($surname);
	echo $pesel."  ".$examine_name."  ".$firstname."  ".$surname."<br>";
	//echo $pesel.$examine_name.$firstname.$surname."<br>";
	$pesel_length = strlen ($pesel);		
	//echo $pesel_length."<br>";
	if($pesel_length != 11)
	{
		$status = false;
		echo "Nieprawidłowy pesel: sprawdź poprawność danych w nagłówku pliku!<br>";
		//$_SESSION['e_number'] = "Pesel powinien mieć 11 cyfr: sprawdź poprawność danych w nagłówku pliku!<br>";
	}	

	$data=date("Y-m-d");

	mysqli_report(MYSQLI_REPORT_STRICT);	//łączenie z bazą danych i wstawianie rekordu do tabeli z rekordami dla odpowiedniego pacjenta
	if($status==true)
	{
		try 
		{
			$connection = new mysqli($host,$db_user,$db_password,$db_name);
			if($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result = $connection->query("SELECT id_pacjenta FROM pacjenci WHERE pesel='$pesel'");
														
				if(!$result) throw new Exception($connection->error);
			
				if($result->num_rows==0)
				{
					if ($connection->query("INSERT INTO pacjenci VALUES (NULL, '$firstname', '$surname', '$pesel')")) 
					{		
						echo "Nieznany pesel: dodano nowego pacjenta do bazy dla tego badania<br>";
					}
					else
					{
						echo "Błąd przy dodawaniu pacjenta do bazy: sprawdź nagłówek pliku!<br>";
					}
				}
				$result = @$connection->query("SELECT id_pacjenta FROM pacjenci WHERE pesel='$pesel'");
					
				if(!$result) throw new Exception($connection->error);						
				
				if ($result->num_rows > 0) 
				{
					// output data of each row
					while($row = $result->fetch_assoc()) 
					{
						$idPacjenta = $row['id_pacjenta'];
					}
						
					if ($connection->query("INSERT INTO badania VALUES (NULL, '$idPacjenta', '$examine_name', '$data', '$file_name')"))
					{
						echo "Dodano badanie do kartoreki pacjenta<br>";
						$connection->close();
						$time = microtime();
						$time = explode(' ', $time);
						$time = $time[1] + $time[0];
						$finish = $time;
						$_SESSION['total_time'] = round(($finish - $start), 4);
					} 
					else
					{
						throw new Exception($connection->error);
					}
				}
			}
		}	
			catch (Exception $e) 
			{
				echo '<div class="error">"Błąd serwera"</div>';
				echo $e."<br/>";
			}	
	}
	else {
		if(isset($_SESSION['e_number']))
			{
				echo '<div class = "error"><br>'.$_SESSION['e_number'].'</div>';
				unset($_SESSION['e_number']);
			}	
		echo 'Plik nie ma poprawnego formatu';
	}
  }
	if(isset($_SESSION['total_time']))
	{
		echo '<br><br>Zrealizowano w:  '.$_SESSION['total_time'].' sekundy<br><br>';
		unset($_SESSION['total_time']);
		//header('Location: upload.php'); 	//Przekierowanie do jakiejś tam strony do której chcemy
	}
}
?>

	</div>
</div>	

<?php
	require_once "footer.php";
?> 


         
