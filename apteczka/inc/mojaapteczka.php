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
  <h2>Moja apteczka domowa</h2>     
  <table class="table table-bordered" id=tabela>
    <thead>
      <tr>
        <th>Nazwa</th>
        <th>Ilość</th>
        <th>Cena</th>
        <th>Data ważności</th> 
        <th>Zużycie</th>        
      </tr>
    </thead>
  </table>
</div>

<?php 
	require_once "stopka.php";
?>