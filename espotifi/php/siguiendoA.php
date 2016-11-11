<?php
session_start();
?>
<?php
//muestra a que usuarios se esta siguiendo en el home
include '../clases/database.php';

	$usuario = $_SESSION['nombre'];	
				
	$db = new database();
	$db->conectar();
	$db->siguiendoA($usuario);
					
?>