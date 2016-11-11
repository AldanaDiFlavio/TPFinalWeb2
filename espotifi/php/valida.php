<?php
	session_start();
?>
	  

<?php

include '../clases/database.php';
include '../clases/users.php';

$nombre = $_POST['nombre'];
$contrasena	= md5($_POST['contrasena']);
$recordar = $_POST['recordar'];
$_SESSION['nombre'] = $nombre;


if (empty($nombre) || empty($contrasena))
		{
		echo "Debe ingresar los dos campos";
		echo '<br> <a href = "../index.php"> Login </a>';
		}
		else{
			$bd = new database();
			$bd->conectar();

			$bd->buscar($nombre, $contrasena);
									
			$resultado = mysqli_num_rows($bd->validar);
			$inf = mysqli_fetch_assoc($bd->validar);
			
			$bd->close();
			//mysqli_close($link);
			
			if ($inf["Habilitado"] == "false") 
					{
					$_SESSION["habilitado"]="false"; 
					header('location: ../index.php');
					} 
					else{				
						if ($resultado == 1)
								{//RECORDAR USUARIO Y CLAVE SOLO EN LOS BOXES DEL LOGIN
								if ($inf["Administrador"] == "false")
											{
											if ($recordar == "true")
														{
														setcookie("nombre", $nombre, time()+60*60*20, "/");
														setcookie("password", $contrasena, time()+60*60*20, "/");
																						
														$_SESSION["login"] = "on";
																					
														header('location: ../html/home.php');
														}
														else{
															// Limpiar cookies
															setcookie("nombre", "", time()-3600, "/");
															setcookie("password", "", time()-3600, "/"); 
																																														
															// 	La cookie expira cuando se cierra el navegador
															/* 	setcookie("nombre", $nombre, false, "/");
																setcookie("password", $pass, false, "/"); */
																														
															$_SESSION['login'] = "on";
															header('location: ../html/home.php');
															}
											}
											else 
													{
													if ($recordar == "true")
																{
																setcookie("nombre", $nombre, time()+60*60*20, "/");
																setcookie("password", $contrasena, time()+60*60*20, "/");
																								
																$_SESSION["login"] = "on";
																							
																header('location: ../html/homeAdmin.php');
																}
																else{
																	// Limpiar cookies
																	setcookie("nombre", "", time()-3600, "/");
																	setcookie("password", "", time()-3600, "/"); 
																																																
																	// 	La cookie expira cuando se cierra el navegador
																	/* 	setcookie("nombre", $nombre, false, "/");
																		setcookie("password", $pass, false, "/"); */
																																
																	$_SESSION['login'] = "on";
																	header('location: ../html/homeAdmin.php');
																	}
													}
								}
								else{
									//echo "El usuario o contrasena son incorrectos";
									$_SESSION["valida"]="true";
									header('location: ../index.php');
									}
						}
			}
		
?>
			
