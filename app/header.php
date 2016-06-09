<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor's interface</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel = "stylesheet" type = "text/css" href = "css/index.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script>
		document.getElementById("uploadBtn").onchange = function () {
		document.getElementById("uploadFile").value = this.value;
		};
	</script>
</head>
<body style="background-color: #C6DEC6">
<nav class="navbar navbar-inverse visible-xs" style="border-color:#E4F6E4" >
  <div class="container-fluid" >
    <div class="navbar-header">
    <a class="navbar-brand" href="main.html"> <i class="fa fa-user-md" style="font-size:20px"></i></a>
      <div class="col-sm-6 dropdown">
        <div class="burger-menu">
          <span class="glyphicon glyphicon-align-justify" style="font-size:30px" style="margin-top:10px"></span>
        </div>
        <div class="dropdown-content">
          <a href="main.php">Home</a>
          <a href="upload.php">Upload</a>
          <a href="records.php">Records</a>
        </div>
    </div>
    </div>
  </div>
</nav>




