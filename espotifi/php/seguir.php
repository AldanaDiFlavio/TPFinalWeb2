<?php
session_start();
?>

<?php				
	include "../clases/database.php";
	
	$usuario = $_SESSION['nombre'];
	$siguiendo = $_GET['siguiendo'];
		
	$db = new database();
	$db->conectar();
				
	$db->seguir($usuario,$siguiendo);
	$db->paraSeguir();		
?>