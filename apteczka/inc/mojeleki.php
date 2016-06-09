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
  <h2><?php echo $menuMojeLeki?></h2>     
  <table class="table table-bordered" id=tabela>
    <thead>
      <tr>
        <th><?php echo $dodNazwa?></th>
		<th><?php echo $dodJednostka?></th>
        <th><?php echo $dodIloscOpakowan?></th>
		<th><?php echo $dataWaznosci?></th>        
      </tr>
</div>

<?php 
	require_once "stopka.php";
?>