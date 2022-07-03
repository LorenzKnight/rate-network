<?php

if (!isset($_SESSION)) {
  session_start();
}

$hostname_con = "p:localhost";
$database_con = "ratenet";
$username_con = "root";
$password_con = "root";
$con = mysqli_connect($hostname_con, $username_con, $password_con, $database_con);
mysqli_set_charset($con, 'utf8');

if (is_file("inc/functions.php")) 
include("inc/functions.php"); 
else
{
	include("../inc/functions.php");
}
?>
<!-- CAMBIAR EL VALOR DE ESTA VARIABLE PARA QUE LOS LINK FUNCIONEN -->
<?php
  // // $dominio = "www.ticketsgenerator.com";
  // $dominio = "http://localhost:8888";
  // // $dominio = "localhost:8888";
  $pageName = "Rate";
?>