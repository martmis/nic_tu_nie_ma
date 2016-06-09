<?php
	include("nagl.php");
		echo "<H2>Tablice jednowymiarowe</H2><p>";
		//Tablice jednowymiarowe
		$tbl1[0]=0;
		$tbl1[1]=10;
		$tbl1[2]=20;
		$tbl1[3]=30;
		
		$tbl2[]="zero";
		$tbl2[]="jeden";
		$tbl2[]="dwa";
		$tbl2[]="trzy";
		
		$tbl3 = Array("ZEROWY", "PIERWSZY", "DRUGI". "TRZECI", 0, 1, 2, 3);
		
		//wypisanie tablicy
		//funkcja count liczy rozmiar tablicy
		for($i =0; $i<count($tbl1); $i++)
			echo $tbl1[$i] . "<br />";
		echo "<hr /><p>";
		
		for($i=0; $i<count($tbl2); $i++)
			echo $tbl2[$i] . "<br />";
		echo "<hr /><p>";
		
		for($i=0; $i<count($tbl3); $i++)
			echo $tbl3[$i] . "<br />";
		echo "<hr /><p>";
		
		print_r($tbl3);
		include("stopka.php");
	?>