<?php


class user {
			private $idUsuario;
			private $nombre;
			private $contrasena;
			private $email;
			private $administrador;
			private $habilitado;
			private $ubicacion;
			private $fecha;
			private $denuncias;
			
			public function __construct($idUsuario, $nombre, $contrasena, $email, $administrador, $habilitado, $ubicacion, $fecha)
										{
										$this->idUsuario = $idUsuario;
										$this->nombre = $nombre;
										$this->contrasena = $contrasena;
										$this->email = $email;
										$this->administrador = $administrador;
										$this->habilitado = $habilitado;
										$this->ubicacion = $ubicacion;
										$this->fecha = $fecha;
										$this->denuncias = "0";
										/*
										$link = mysqli_connect('localhost', 'root', 'mysql153', 'web2')
										or die('No se pudo conectar:'  . mysqli_error($link));
										echo 'Conexion establecida <br>';
										$sql = "INSERT INTO Usuarios (idUsuario, nombre, contrasena, email, administrador, habilitado, ubicacion, fecha) 
															  VALUES ('$this->idUsuario', '$this->nombre', '$this->contrasena', '$this->email', '$this->administrador', '$this->habilitado', '$this->ubicacion', '$this->fecha');";
										$gg = mysqli_query($link, $sql) or die("error");
										mysqli_close($link);
										*/
										
										$db = new database();
										$db->conectar();
										
										$sql = "INSERT INTO Usuarios (idUsuario, Nombre, Contrasena, email, Ubicacion, Administrador, Habilitado, Fecha, Denuncias) 
															  VALUES ('$this->idUsuario', 
															  '$this->nombre', 
															  '$this->contrasena', 
															  '$this->email', 
															  '$this->ubicacion', 
															  '$this->administrador', 
															  '$this->habilitado', 
															  '$this->fecha',
															  '$this->denuncias');";
								
										$gg = mysqli_query($db->conexion, $sql) or die("error de registro");
								
										$db->close();
										
										}

	
}


?>