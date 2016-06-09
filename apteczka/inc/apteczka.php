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
  <h2>Wprowadź lekarstwo do apteczki</h2>     
  <table class="table table-bordered" id=tabela>
    <thead>
      <tr>
      	<th><input type="checkbox">
        <th>Nazwa</th>
        <th>Ilość</th>
        <th>Cena</th>
        <th>Data ważności</th>                
      </tr>
    </thead>
  </table>  
</div>

<?php 
	require_once "stopka.php";
?>