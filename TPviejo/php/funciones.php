<?php

function conectar() {
					$conexion = mysqli_connect('localhost', 'root', 'mysql153', 'web2')
								or die('No se pudo conectar:'  . mysqli_error($conexion));
								echo 'Conexion establecida <br>';
					
					return $conexion;
					}

function buscar($link, $nombre, $contraseña)
					{					
					$validar = mysqli_query ($link, "SELECT * from Usuarios WHERE nombre LIKE '$nombre' AND contraseña LIKE '$contraseña';")
					or die ("Fallo la consulta");
						
					return $validar;
					}
					
function ver($nombre, $link)
					{								
					$mostrar = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre';";
					$query = mysqli_query($link, $mostrar) or die ("Fallo la consulta");
						
					$ver = mysqli_fetch_assoc($query);
								
					echo "<br>Nombre: " . $ver["nombre"] . "<br>Contraseña: " . $ver["contraseña"] . "<br>Tipo de usuario: " . $ver["administrador"] . "<br>Habilitado: " . $ver["habilitado"];
					}			

function modificar($nombre, $link)
					{								
					$mostrar = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre';";
					$query = mysqli_query($link, $mostrar) or die ("Fallo la consulta");
					}								
					
function borrar($nombre, $link)
					{								
					$delete = "DELETE FROM usuarios WHERE nombre LIKE '$nombre';";
					$query = mysqli_query($link, $delete) or die ("Fallo la consulta");
													
					echo "El usuario  $nombre  ha sido borrado";
					}					
?>