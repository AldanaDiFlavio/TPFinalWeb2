<?php

class user {
			private $idUsuario;
			private $nombre;
			private $contraseña;
			private $email;
			private $administrador;
			private $habilitado;
			private $ubicacion;
			private $fecha;
			
			public function __construct($idUsuario, $nombre, $contraseña, $email, $administrador, $habilitado, $ubicacion, $fecha)
										{
										$this->idUsuario = $idUsuario;
										$this->nombre = $nombre;
										$this->contraseña = $contraseña;
										$this->email = $email;
										$this->administrador = $administrador;
										$this->habilitado = $habilitado;
										$this->ubicacion = $ubicacion;
										$this->fecha = $fecha;

										$link = mysqli_connect('localhost', 'root', 'mysql153', 'web2')
										or die('No se pudo conectar:'  . mysqli_error($link));
										echo 'Conexion establecida <br>';
								
										$sql = "INSERT INTO Usuarios (idUsuario, nombre, contraseña, email, administrador, habilitado, ubicacion, fecha) 
															  VALUES ('$this->idUsuario', '$this->nombre', '$this->contraseña', '$this->email', '$this->administrador', '$this->habilitado', '$this->ubicacion', '$this->fecha');";
								
										$gg = mysqli_query($link, $sql) or die("error");
								
										mysqli_close($link);
										}
			
			public function veruser()
									{
									echo $this->nombre;
									echo $this->clave;
									echo $this->tipo;
									echo $this->habilitado;
									}
	
}


?>