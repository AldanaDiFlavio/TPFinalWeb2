<?php
session_start();
?>

<?php
include '../clases/users.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date("Y-m-d H:i:s");

$idUsuario = "1";
$nombre = $_POST["nombre"];
$pass1	= $_POST["pass1"];
$pass2	= $_POST["pass2"];
$email  = $_POST["email"];
$administrador	= "false";
$habilitado = "true";
$ubicacion = "Argentina"; 


if($nombre!=NULL )	{
					if($pass1!=NULL && $pass2!=NULL){
													if($pass1 == $pass2){
																		$contraseña = md5($pass2);
																																				
																		$usuario = new User($idUsuario, $nombre, $contraseña, $email, $administrador, $habilitado,
																							$ubicacion, $fecha);
																																				
																		$_SESSION["reg"]="true";
																		
																		header('location: ../index.php');
																		}
																		else{
																			echo "Las contraseñas no coinciden";
																			}
													}else{
														 echo "Faltan datos para completar el registro";
														 }
					}
					else{
						echo "Faltan datos para completar el registro";
						}
								
?>

