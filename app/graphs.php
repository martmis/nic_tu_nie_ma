<?php
	//poprawic wzgledem logowania
	session_start();
	
	require_once "header.php";
?>

<div class="container-fluid" id = "parentContainer" >
  <div class="row content" id = "rowContent">
    <div class="col-sm-3 sidenav hidden-xs">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php" onclick="ChangeBack()">Home</a></li>
        <li><a href="upload.php">Upload</a></li>
        <li><a href="records.php">Records</a></li>
		<li  class = "active"><a href="graphs.php">Graphs</a></li>
      </ul><br>
    </div>
    <br>
    <div class="container-fluid col-sm-9">
      <div class="well" id = "mainContainer">
        
      </div>
    </div>
	
<?php

	session_unset ();
	
	require_once "footer.php";
?>
