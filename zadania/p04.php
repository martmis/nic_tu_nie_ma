<?
	include("nagl.php");
	//Pierwsze petle
		echo "<p>";
	for($i = 0; $i <10; $i++)
		print("Linia o numerze $i - FOR<br />");
	
		echo "</p><hr />";
		echo "<p>";
		$i=0;
	while($i<10) {
		print("Linia o numerze $i - WHILE<br />");
		$i++;
	}
		echo "</p><hr />";
		echo "<p>";
		$i = 0;
	do{
		print ("Linia o numerze $i - DO WHILE<br />");
		$i++;
	} while($i<10);
	echo "</p>";
	
	include("stopka.php");
?>