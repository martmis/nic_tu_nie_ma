<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
	header('Location:index.php');
	exit();
}

require_once "../conf/zmienne.php";
require_once "$lang/error_msg.php";
require_once "$lang/teksty.php";
require_once "funkcje.php";
require_once "nagl.php";
require_once "menu.php";

echo "Witaj ".$_SESSION['user']."!";

require_once "stopka.php";



?>