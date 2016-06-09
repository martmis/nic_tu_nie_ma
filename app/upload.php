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
        <li  class = "active"><a href="upload.php">Upload</a></li>
        <li><a href="records.php">Records</a></li>
      </ul><br>
    </div>
    <br>
    <div class="container-fluid col-sm-9">
      <div class="well" id = "mainContainer">
        <h2>Add patient's records:</h2>
		<form action="upload2.php" method="POST" ENCTYPE="multipart/form-data"><br>
			<input id="uploadFile" placeholder="Choose File" disabled="disabled" />
			<div class="btn btn-default btn-file">
				<span>Upload</span>
				<input id="uploadBtn" type="file" class="upload" name="plik" required/>
			</div>
			<br><br><br><input type="submit" value="Wyślij plik"/>

			<?php 
				if(isset($_SESSION['total_time'])){
				echo 'Wysłanie pliku zrealizowano w:  '.$_SESSION['total_time'].' sekundy<br><br>';
				echo 'Plik <b>'.$_SESSION['file_name'].'</b> został dodany do rejestru badań';}
				
			?>
		</form>
      </div>
    </div>
	
<?php
	
	session_unset ();
	
	require_once "footer.php";
?>
