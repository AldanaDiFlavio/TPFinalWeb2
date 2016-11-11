<?php
session_start();
?>
<?php

	include "../clases/database.php";
	$usuario = $_SESSION['nombre'];
	$usuario_denunciado = $_GET['usuario_denunciado'];
	$motivo_denuncia = $_GET['motivo_denuncia'];
		
	$db = new database();
	$db->conectar();
	$db->denunciar($usuario,$usuario_denunciado,$motivo_denuncia);
	
	header('location: ../html/home.php');
	
?>