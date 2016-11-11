<?php
session_start();
?>

<?php				
	include "../clases/database.php";
	
	//$usuario = $_SESSION['nombre'];
	$nombre = $_GET['nombre'];
		
	$db = new database();
	$db->conectar();
	
	$db->habilita($nombre);
	
	$db->listarUsuarios();
	
?>
