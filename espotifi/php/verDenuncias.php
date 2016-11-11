<?php
session_start();
?>
<?php

	include "../clases/database.php";
	$usuario_denunciado = $_GET['nombre'];
	
	//echo $usuario_denunciado;
		
	$db = new database();
	$db->conectar();
	$db->verDenuncias($usuario_denunciado);
	
?>