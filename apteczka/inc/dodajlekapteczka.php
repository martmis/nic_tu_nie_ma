<?php 
	session_start();
	require_once "../conf/zmienne.php";
	require_once "$lang/error_msg.php";
	require_once "$lang/teksty.php";
	require_once "funkcje.php";
	
	require_once "nagl.php";
	require_once "menu.php";	
	
?>

<div class="container">
  <h2><?php echo $dodLekApteczka?></h2>     
  <table class="table table-bordered" id=tabela>
    <thead>
      <tr>
        <th><?php echo $dodNazwa?></th>
        <th><?php echo $dodIloscOpakowan?></th>
		<th><?php echo $dataWaznosci?></th>        
      </tr>
	  <form action="" method=POST>
		<tr>
			<div class="blacktext">
				<th><font color="black"><input type="text" name="nazwa" required></font></th>				
				<th><font color="black"><input type="text" name="ilosc_opakowan" required></font></th>
				<th><font color="black"><input type="date" name="data_waznosci" value="11/11/2021" required></font></th>
			</div>
		</tr></br>
    </thead>
  </table>
  </br></br>
  <div class ="" align="center">
	<button input type="submit" class="btn btn-loguj" align="center"><?php echo $dodLek?>
  </div></br>
</form>
</div>

<?php 
	require_once "stopka.php";
?>
