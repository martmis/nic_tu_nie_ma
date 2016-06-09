<?php 
	session_start();
	
	require_once "../conf/zmienne.php";
	require_once "$lang/error_msg.php";
	require_once "$lang/teksty.php";
	require_once "funkcje.php";
	
		//wylogowanie
	//if($_GET['wyloguj']==1)
	//{
		//session_destroy();
	//}
	
	
	//spr czy zalogowany
	if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true)
	{
		header('Location:inc/glowna.php');
		exit(); // zeby od razu wyjsc z kodu - > i przejsc do pliku gra.php
		// gdy uzytkonwik jest juz zalogowany	
	}


require_once "nagl.php";	
require_once "menu.php";

if(isset($_SESSION['blad']))
	{
		echo $_SESSION['blad'];
	}
?>

<div class="container" id=logowanie>
	<H2 align="center"><?php echo $lgLogowanie?></H2></br>
	<form class="form-horizontal" action="zaloguj.php" method="POST">
			<fieldset> 
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $lbNick?></label>
					<div class="col-sm-10" id="input_text">
						<input type="text"  class="form-control" name="login" placeholder="<?php echo $logNickpch?>"></font>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $lbHaslo?></label>	
					<div class="col-sm-10" id="input_text">
						<input type="password" class="form-control" name="haslo" placeholder="<?php echo $logHaslopch?>"></font>
					</div>
				</div>
				
				<div class="form-group" align="center">
					<div class="col-sm-12">
						<button input type="submit" class="btn btn-loguj"><?php echo $logZaloguj?>
							<span class="glyphicon glyphicon-ok"> </span>
						</button></br>
					</div>
				</div>
			</fieldset>
	</form>
	<div class="form-group" align="center">
					<div class="col-sm-12">
						<label><?php echo $logNieMaszKonta?></label>
						<a href="rejestracja.php">
							<button><?php echo $logZarejestruj?></button>
						</a></br></br>
					</div>
				</div>
</div>
	<div class="col-sm-3"> </div>
</div>			
</div>


	
<?php
	require_once "stopka.php";
?>	
	