<?php
session_start();
?>
<?php
//$nombre = $_GET['nombre'];
include '../clases/database.php';

if ($_SESSION["perfil"] == "mostrar")
		{
		$_SESSION["show"] = "ocultar";
		$_SESSION["perfil"] = "ocultar";
		$nombre = $_SESSION['nombre'];	
				
		$db = new database();
		$db->conectar();
		$db->ver($nombre);
		}
		else if ($_SESSION["perfil"] == "ocultar")
				{
				$_SESSION["show"] = "ver";
				$_SESSION["perfil"] = "mostrar";	
				echo "";
				}
					
?>