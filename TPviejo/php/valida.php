<?php
	session_start();
?>
	  

<?php

include 'funciones.php';
include '../clases/users.php';

$nombre = $_POST['nombre'];
$contraseña	= md5($_POST['contraseña']);
$recordar = $_POST['recordar'];



if (empty($nombre) || empty($contraseña))
		{
		echo "Debe ingresar los dos campos";
		echo '<br> <a href = "../index.php"> Login </a>';
		}
		else{
			$link = conectar();

			$validar = buscar($link, $nombre, $contraseña);
			
			$resultado = mysqli_num_rows($validar);
			
			$inf = mysqli_fetch_assoc($validar);
			
			mysqli_close($link);
		
			if ($inf["habilitado"] == "no") {
											$_SESSION["habilitado"]="no"; 
											header('location: ../index.php');
											} 
			else{				
			if ($resultado == 1){						//RECORDAR USUARIO Y CLAVE SOLO EN LOS BOXES DEL LOGIN
								if ($recordar == "true"){
														setcookie("nombre", $nombre, time()+60*60*20, "/");
														setcookie("password", $contraseña, time()+60*60*20, "/");
															
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
								else{
									echo "El usuario o contraseña son incorrectos";	
									}
						
				}
		}
		
?>
			
