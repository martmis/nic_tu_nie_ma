<?php
	
	require_once "header.php";
	
	if (isset($_POST['usrname'])&isset($_POST['surname'])
		&isset($_POST['age'])&isset($_POST['pesel']))
		{
			$usrname = $_POST['usrname'];
			$surname = $_POST['surname'];
			$sex = $_POST['sex'];
			$age = $_POST['age'];
			$pesel = $_POST['pesel'];
			
			$status = true; //wpozo 
			
			//spr czy sa liczbami
			if((ctype_digit($age) ||  ctype_digit($pesel))!=true)
			{
				$status = false;
				$_SESSION['e_number'] = "Proszę podać liczbę";
			}
			
			$pesel_length = strlen ($pesel);
			
			
			if($pesel_length != 11)
			{
				$status = false;
				$_SESSION['e_number'] = "Pesel powinien mieć 11 cyfr";
			}	
		}
				
				require_once "uploadConfig.php";
				
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$connection = new mysqli($host,$db_user,$db_password,$db_name);
					
					if($connection->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{	
						//czy pesel juz istnieje
						$result = $connection->query("SELECT id_pacjenta FROM pacjenci WHERE 
						pesel='$pesel'");
												
						if(!$result) throw new Exception($connection->error);
						
						$num_pesel = $result->num_rows;
				
						if($num_pesel>0)
						{
							$status = false;
							$_SESSION['e_number'] = "Pacjent o podanym peselu już istnieje";
						}
						
						if($status==true)
						{
							if ($connection->query("INSERT INTO pacjenci VALUES (NULL, '$usrname', 
							'$surname', '$age', '$pesel', '$sex')"))
							{
								header('Location: upload.php');
							}
							else
							{
								throw new Exception($connection->error);
							}	
						}
						$connection->close();
					}
				}
				catch (Exception $e) 
				{
					echo '<div class="error">"Błąd serwera"</div>';
					echo $e."<br/>";
				}				

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
		<div class="modal-content">
			<div class="modal-body" style="padding:40px 50px;">
			<ul class="pager">
				<li class="previous"><a href="upload.php">&larr; Previous</a></li>
			</ul>
				<form role="form" method=POST>
					<div class="form-group">
						<label for="usrname">Firts Name</label>
						<input type="text" class="form-control" name="usrname" placeholder="Enter name" required>
					</div>
					<div class="form-group">
						<label for="usrname">Last Name</label>
						<input type="text" class="form-control" name="surname" placeholder="Enter surname" required>
					</div>
					<div class="form-group">
						<label for="usrname">Sex</label><br>
							<input type="radio" name="sex" value="K" required>
							<label>Female</label><br>
							<input type="radio" name="sex" value="M" required>					
								<label>Male</label>
					</div>
					<div class="form-group">
						<label for="usrname">Age</label>
						<input type="number" class="form-control" name="age" required>
					</div>
					<div class="form-group">
						<label for="usrname">Pesel</label>
						<input type="number" class="form-control" name="pesel" required>
					</div>
					
					<div style="font:bold; color: red;">
					<?php if(isset($_SESSION['e_number']))
					{
						echo '<div class="error">'.$_SESSION['e_number'].'</div>';
						unset($_SESSION['e_number']);
					}?>
					<br></div>
					<button type="submit" class="btn btn-success btn-block" style="font-size : 20px; width: 60%; margin: 0 auto;"><a href = "addpatient.php"><span class="glyphicon glyphicon-plus"></span> Add Patient</a></button>
			  </form>       
			</div>
        </div>
    </div>

<?php
	
	require_once "footer.php";

?>