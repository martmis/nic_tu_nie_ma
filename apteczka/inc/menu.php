<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home"></span><?php echo $tytul;?></a>
    </div>
    
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="glowna.php"><span class="fa fa-medkit"></span><?php echo $menuApteczka;?> <span class="sr-only">(current)</span></a></li>
        <li><a href="dodajlek.php"><span class="fa fa-user-md"></span><?php echo $menuDodajLek;?></a></li>
        <li><a href="mojeleki.php"><span class="glyphicon glyphicon-user"></span><?php echo $menuMojeLeki;?></a></li>
		<li><a href="wybrano=4"><span class="fa fa-bar-chart"></span><?php echo $menuAnaliza;?></a></li>
	    <li><a href="wybrano=5"><span class="glyphicon glyphicon-list-alt"></span><?php echo $menuRaport;?></a></li>
      </ul>
		    
		    
	 <ul class="nav navbar-nav navbar-right">
	    <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span><?php echo $menuLog?></a></li>
	    <li><a href="wyloguj.php"><span class="glyphicon glyphicon-log-out"></span><?php echo $menuWyloguj;?></a></li>
	 </ul>
	</div>
</header>




