<?php
$server = "proyectparadox.com";
$db = "proye145_cuda_dweb";
$user = "proye145_cuda" ;
$password = "Estrella.1092?";
$mysqli = new mysqli($server, $user, $password, $db);
   if($mysqli->connect_errno){
	   echo "Lo sentimos este sitio web está experimentando problemas";
	   echo "Error: Fallo al conectarse a MySQL debido a: \n";
	   echo "Errno: " . $mysqli->connect_errno . "\n";
	   echo "Errno: " . $mysqli->connect_errno . "\n";
	   exit;
   }

   try{
	$db = new PDO('mysql:host=proyectparadox.com; dbname=proye145_cuda_dweb', 'proye145_cuda', 'Estrella.1092?');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex) {
    echo "An Error occured!"; 
    some_logging_function($ex->getMessage());
}
?>