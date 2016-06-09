<!DOCTYPE HTML>
<html lang='pl'>
<head>
	<title>Piekarnia</title>
	<meta charset="UTF-8">
</head>

<body>

<?php

	$paczek = $_POST['paczek'];
	$grzebien = $_POST['grzebien'];
	$suma = $paczek*0.99 + $grzebien*1.29;
	
echo<<<END
	<h2>Podsumowanie zamówienia</h2>
	<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<td>Pączek 0.99PLN/sztuka</td>
		<td>$paczek</td>
	</tr>
	<tr>
		<td>Grzebień 1.29/sztuka</td>
		<td>$grzebien</td>
	</tr>
	<tr>
		<td>Suma</td>
		<td>$suma PLN</td>
	</tr>
	</table>
	<br><a href="zamowienie.php">Powrót do strony głównej</a>
END;

?>
</body>
</html>