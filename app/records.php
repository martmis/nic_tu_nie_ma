<?php
	//poprawić względem logowania
	session_start();
	
	require_once "header.php";
?>

<div class="container-fluid" id = "parentContainer" >
  <div class="row content" id = "rowContent">
    <div class="col-sm-3 sidenav hidden-xs">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php" onclick="ChangeBack()">Home</a></li>
        <li ><a href="upload.php">Upload</a></li>
        <li class="active"><a href="records.php">Records</a></li>
      </ul><br>
    </div>
    <br>
    <div class="container-fluid col-sm-9">
      <div class="well" id = "mainContainer">
        <ul class="pager">
          <li class="previous"><a href="#">&larr; Previous</a></li>
          <li class="next"><a href="#">Next &rarr;</a></li>
        </ul>
		
		<form  method="POST" >
			<p>Wyszukaj badania:</p>
			<p>Imie</p>
			<input type="text" name="imie" />
			<br><br><p>Nazwisko</p>
			<input type="text" name="nazwisko" />
			<br><br><p>Pesel</p>
			<input type="number" name="pesel" />
			<br><br><p>Typ badania</p>
			<input type="text" name="typBadania" />
			<br><br><p>Data badania</p>
			<input type="date" name="dataBadania" />
			<br><br>
			<input type="submit" value="Szukaj badań" name="zFiltrami"/>
			<br><br>
			<input type="submit" value="Wyświetl wszystkie badania" name="bezFiltrow"/><br>
		</form>		
		<br><br>
		<?php 
			if(isset($_SESSION['total_time']))
			echo 'Zapytanie zrealizowano w:  '.$_SESSION['total_time'].' sekundy<br><br>';
			require_once "filtry.php";
		?>
      </div>
    </div>

<?php
	require_once "footer.php"
?>