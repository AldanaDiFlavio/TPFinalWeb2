<?php
require "config.php";

class database	{
				public $conexion;
				public $validar;
								
				public function __construct(){}
				
				public function conectar() 
						{
						$this->conexion = mysqli_connect(HOST, USER, PASS, DBNAME)
						or die('No se pudo conectar:'  . mysqli_error($this->conexion));
						}
											
				public function close()	
						{
						mysqli_close($this->conexion);
						}
				//busca el usuario en la base durante el login						
				public function buscar($nombre, $contrasena)
						{					
						$this->validar = mysqli_query ($this->conexion, "SELECT * from Usuario WHERE nombre LIKE '$nombre' AND contrasena LIKE '$contrasena';")
						or die ("Fallo la consulta");
						}
				
				
				public function ver($nombre)
						{								
						//$mostrar = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre';";
						$query = mysqli_query($this->conexion, "SELECT * FROM usuario WHERE nombre LIKE '$nombre';") or die ("Fallo la consulta");
						$ver = mysqli_fetch_assoc($query);
						
						echo "<br>Id: " . $ver["idUsuario"] .
							"<br>Nombre: " . $ver["Nombre"] . 
							"<br>Contrasena: " . $ver["Contrasena"] . 
							"<br>Email: " . $ver["email"] . 
							"<br>Administrador: " . $ver["Administrador"] . 
							"<br>Habilitado: " . $ver["Habilitado"] . 
							"<br>Ubicacion: " . $ver["Ubicacion"] .
							"<br>Fecha: " . $ver["Fecha"] .
							"<br>Denuncias: " . $ver["Denuncias"];
						}			

					
				/*public function modificar($nombre, $newEmail, $pass)
						{								
						$query = mysqli_query($this->conexion, "SELECT * FROM usuarios WHERE nombre LIKE '$nombre';") or die ("Fallo la consulta");
						$mod = mysqli_fetch_assoc($query);
											
						$contrasena = $mod["Contrasena"];
						$email = $mod["email"];
						
						if ($contrasena == $pass)	{
													echo "Las contraseña vieja y la nueva son iguales";
													}
													else{
													$query = mysqli_query($this->conexion, "UPDATE usuarios SET Contrasena = '$pass' WHERE nombre LIKE '$nombre';") or die ("Fallo la consulta");	
													}
						if ($email == $newEmail)	{
													echo "Las direcciones de correo vieja y nueva son iguales";
													}
													else{
													$query = mysqli_query($this->conexion, "UPDATE usuarios SET email = '$newEmail' WHERE nombre LIKE '$nombre';") or die ("Fallo la consulta");	
													}												
						}*/
				
				//habilita o deshabilita un usuario (ban) tambien se utiliza para la validacion por mail
				public function habilita($nombreId)
						{
						$sql="SELECT Habilitado FROM usuario WHERE Nombre = '$nombreId';";
						$resultado = mysqli_query($this->conexion,$sql);
						$ver = mysqli_fetch_assoc($resultado);
		
						if($ver["Habilitado"] == "true")
								{
								//deshabilita usuario
								$sql="UPDATE usuario SET Habilitado = 'false' WHERE Nombre = '$nombreId';";
								$resultado = mysqli_query($this->conexion,$sql);
								}
								else{
									//habilita usuario
									$sql="UPDATE usuario SET Habilitado = 'true' WHERE Nombre = '$nombreId';";
									$resultado = mysqli_query($this->conexion,$sql);
									}
						}	
				//muestra todos los usuarios en el home del admin
				public function listarUsuarios()
						{
						$query = mysqli_query($this->conexion, "SELECT * FROM usuario;") or die ("Fallo la consulta");
						$registros = mysqli_num_rows($query);
												
						while($ver = mysqli_fetch_assoc($query))
								{
								$nombre = $ver["Nombre"];
								
								//value sin utilidad
								$value = '<?php echo "$nombre"; ?>';
																
								echo "<div style= 'text-align:center; float: left; border-style: solid; border-width: 0px; margin: 5px;' >";	
										echo 	"<br>Id: " . $ver["idUsuario"] .
												"<br>Nombre: " . $ver["Nombre"] . 
												"<br>Contrasena: " . $ver["Contrasena"] . 
												"<br>Email: " . $ver["email"] . 
												"<br>Administrador: " . $ver["Administrador"] . 
												"<br>Habilitado: " . $ver["Habilitado"] . 
												"<br>Ubicacion: " . $ver["Ubicacion"] .
												"<br>Fecha: " . $ver["Fecha"] .
												"<br>Denuncias: " . $ver["Denuncias"];
										echo '<br><button type = "button" onclick = "banear(this.value)" value ='.$nombre.'> Banear </button>';
										echo '<button type = "button" onclick = "verDenuncias(this.value)" value ='.$nombre.'> Ver denuncias </button>';
										//echo '<br><button type = "button" onclick = "exportarPDF(this.value)" value ='.$nombre.'> Exportar </button>';
										echo '<br><a href = "../php/cargarPDF.php?nombre='.$nombre.'"><button> Exportar </button></a>';
								echo  "</div>";
								}		
						}
						
				
				//para seguir o dejar de seguir a un usuario
				public function seguir($usuario, $siguiendo)
						{//validando si ya esta siguiendo o no
						$consulta = "SELECT * FROM sigue WHERE usuario = '$usuario' and siguiendo = '$siguiendo';";
						$query = mysqli_query($this->conexion, $consulta) or die ("Fallo la consulta");
						$resultado = mysqli_num_rows($query);
					
						if( $resultado == 1)
								{
								echo "Dejaste de seguir a " . $siguiendo . "<br>";
								$query = mysqli_query($this->conexion, "DELETE FROM sigue WHERE usuario = '$usuario' AND siguiendo = '$siguiendo';");
								
								}
								else{
									echo "Estas siguiendo a " . $siguiendo . "<br>";
									$query = mysqli_query($this->conexion, "INSERT INTO sigue (usuario, siguiendo) VALUES ('$usuario','$siguiendo');"); 		
									}
						}
				
				
				//muestra a quien estas siguiendo
				public function siguiendoA ($usuario)
						{
						$query = mysqli_query($this->conexion, "SELECT * FROM sigue WHERE usuario LIKE '$usuario';") or die ("Fallo la consulta");
						$registros = mysqli_num_rows($query);
						
						echo "Siguiendo a ". $registros . " usuarios:";
						while ($ver = mysqli_fetch_assoc($query))
								{
								echo "<br>".$ver["siguiendo"];
								}
						}
				
				
				//muestra algunos usuarios para seguir
				public function paraSeguir()
						{								
						$query = mysqli_query($this->conexion, "SELECT Nombre FROM usuarios;") or die ("Fallo la consulta");
						$registros = mysqli_num_rows($query);
										
						while($ver = mysqli_fetch_assoc($query))
							{
							$nombre = $ver["Nombre"];
							$value = '<?php echo "$nombre"; ?>';
														
							echo "<div style= 'text-align:center; float: left; border-style: solid; border-width: 0px; margin: 5px;' >";	
								echo "$nombre";
								echo '<br><button type = "button" onclick = "seguir(this.value)" value ='.$nombre.'> Seguir </button>';
							//	echo '<br><button type = "button" onclick = "denunciar(this.value)" value ='.$nombre.'> Denunciar </button>';
								echo '<button type = "button" onclick ="escribeMotivo(this.value)" value ='.$nombre.'>Denunciar</button>';
							echo  "</div>";
							}
						}	
				
				
				public function denunciar($usuario,$denunciado,$motivo_denuncia)
						{
							//agrega la denuncia a la tabla denuncias_usuarios estableciendo la relacion
							$sql = "INSERT INTO denuncias_usuarios (usuario, usuario_denunciado, motivo) VALUES ('$usuario', '$denunciado', '$motivo_denuncia');";
							$resultado = mysqli_query($this->conexion,$sql);	
							echo "Se realizo la denuncia";	
							
							//suma una denuncia en la tabla usuarios al usuario correspondiente
							$resultado2 = mysqli_query($this->conexion,"SELECT Denuncias FROM Usuarios WHERE nombre = '$denunciado';");	
							$ver = mysqli_fetch_assoc($resultado2);
							$denuncias = $ver["Denuncias"];
							$denuncias += "1";
							$result = mysqli_query($this->conexion,"UPDATE usuarios SET Denuncias = '$denuncias' WHERE Nombre = '$denunciado';");	
						}
				
				public function verDenuncias($usuario_denunciado)
						{
						$sql =  "SELECT usuario, motivo FROM denuncias_usuarios WHERE usuario_denunciado = '$usuario_denunciado';";
						$resultado = mysqli_query($this->conexion,$sql);
						
						while($ver = mysqli_fetch_assoc($resultado))
								{
								echo "Realiza la denuncia:";
								echo $ver["usuario"];
								echo "<br>";
								echo "Causa de la denuncia:";
								echo $ver["motivo"];
								}
						}
				
				
				}						
				
?>