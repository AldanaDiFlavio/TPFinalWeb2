<?php
session_start();
?>

<?php
include '../clases/users.php';
include '../clases/database.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date("Y-m-d H:i:s");

$idUsuario = "1";
$nombre = $_POST["nombre"];
$pass1	= $_POST["pass1"];
$pass2	= $_POST["pass2"];
$email  = $_POST["email"];
$administrador	= "false";
$habilitado = "false";
$ubicacion = "Argentina"; 
$denuncias = "0";

$nombreId = $nombre;
$to = $email;
$subject = "Confirmacion de registro";
$message = "Haga click en el siguiente enlace para confirmar el registro" . " <a href = 'localhost\proyecto\php\confirmacion.php?nombreId=".$nombreId."'> link </a>";
$headers = "From: administrador@example.com";

$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: administrador@example.com";




if($nombre!=NULL )	{
					if($pass1!=NULL && $pass2!=NULL){
													if($pass1 == $pass2){
																		$contrasena = md5($pass2);
																																				
																		$usuario = new User($idUsuario, $nombre, $contrasena, $email, $administrador, $habilitado,
																							$ubicacion, $fecha, $denuncias);
																																				
																		$_SESSION["reg"]="true";
																		mail($to,$subject,$message,$headers);
																		
																		header('location: ../html/index.php');
																		}
																		else{
																			echo "Las contrasenas no coinciden";
																			}
													}else{
														 echo "Faltan datos para completar el registro";
														 }
					}
					else{
						echo "Faltan datos para completar el registro";
						}
								
?>

