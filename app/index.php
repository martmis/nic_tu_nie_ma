<?php
	require_once "header.php";
?>
<div class="container-fluid" id = "parentContainer" >
  <div class="row content" id = "rowContent">
    <div class="col-sm-3 sidenav hidden-xs">
      <ul class="nav nav-pills nav-stacked">
        <li class = "active"><a href="index.php" onclick="ChangeBack()">Home</a></li>
        <li><a href="upload.php">Upload</a></li>
        <li><a href="records.php">Records</a></li>
      </ul><br>
    </div>
    <br>
    <div class="container fluid col-sm-9">
         <div class="well" id = "mainContainer">
           <h4><center><i class="fa fa-user-md" style="font-size:400px"></center></i></h4>
           <p><center>Welcome to our awesome telemedicine interface!<center></p>
         </div>
    </div>
	
<?php
	require_once "footer.php"
?>