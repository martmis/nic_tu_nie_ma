<?php

	session_start();

	$file = fopen ("1_DANE.TXT", "r") or die("Unable to open file!");
	
	$line = fgets ($file);	
	
	list ($pesel, $examine_name, $name, $surname) = explode ("," ,$line);
	
	echo $pesel; ?><br><?
	echo $examine_name;
	echo $name;
	echo $surname;
	
	fclose ($file);
?>
