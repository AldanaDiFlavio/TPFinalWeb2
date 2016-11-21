<?php
session_start();
?>
<?php
//$nombre = $_GET['nombre'];
include '../clases/database.php';

$nombre = $_SESSION['nombreSession'];	
if ($_SESSION['perfil'] == "Ver Perfil")
		{
		$_SESSION['perfil'] = "Ocultar Perfil";
						
		$db = new database();
		$db->conectar();
		$db->ver($nombre);
		$db->close();
		}
		else if ($_SESSION['perfil'] == "Ocultar Perfil")
				{
				$_SESSION['perfil'] = "Ver Perfil";	
				echo "";
				}
		
					
?>