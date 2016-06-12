<?php
	
	session_start();
?>

<?php 
 
	echo $_POST['nazwa'];
	
	$plik= $_POST['nazwa'];
	
	echo "<br>";



	
$file =  "data/".$plik;


$Czas=array();
$aX=array();
$aY=array();
$aZ=array();

	$lines = file($file);


	for($i=0; $i<2; ++$i) {
	$ktora=$i; //Numer lini do usuniecia pamietaj linie liczymy od 0
	unset($lines[$ktora--]); //Usuwamy wskazana linie z tablicy(pliku txt)
	$plik=fopen($lines,'w');  //Otwieramy plik
	fwrite($plik,join('',$lines)); //Zapisujemy plik bez lini $ktora
	fclose($plik);  //Zamykamy
	}
	
foreach($lines as $line)
{
list( $Czastmp, $aXtmp, $aYtmp, $aZtmp) = split("\t", $line );
array_push($Czas, $Czastmp);
array_push($aX, $aXtmp);
array_push($aY, $aYtmp);
array_push($aZ,$aZtmp);
}

foreach($Czas as $indice => $valor)
print "$valor <br>";

echo "....<BR>";

foreach($aX as $indice => $valor)
print "$valor <br>";

echo "....<BR>";

foreach($aY as $indice => $valor)
print "$valor <br>";
 
 echo "....<BR>";
 
 
foreach($aZ as $indice => $valor)
print "$valor <br>"; 


 ?>
 

