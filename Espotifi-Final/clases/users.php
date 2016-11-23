<?php


class user {
			private $idUsuario;
			private $nombre;
			private $contrasena;
			private $email;
			private $administrador;
			private $habilitado;
			private $ubicacion;
			private $pais;
			private $coordenadas;
			private $fecha;
			private $denuncias;
			
			public function __construct($idUsuario, $nombre, $contrasena, $email, $administrador, $habilitado, $ubicacion, $pais, $coordenadas, $fecha, $denuncias)
										{
										$this->idUsuario = $idUsuario;
										$this->nombre = $nombre;
										$this->contrasena = $contrasena;
										$this->email = $email;
										$this->administrador = $administrador;
										$this->habilitado = $habilitado;
										$this->ubicacion = $ubicacion;
										$this->pais = $pais;
										$this->coordenadas = $coordenadas;
										$this->fecha = $fecha;
										$this->denuncias = $denuncias;
										/*
										$link = mysqli_connect('localhost', 'root', 'mysql153', 'web2')
										or die('No se pudo conectar:'  . mysqli_error($link));
										echo 'Conexion establecida <br>';
										$sql = "INSERT INTO Usuarios (idUsuario, nombre, contrasena, email, administrador, habilitado, ubicacion, fecha) 
															  VALUES ('$this->idUsuario', '$this->nombre', '$this->contrasena', '$this->email', '$this->administrador', '$this->habilitado', '$this->ubicacion',$this->pais, '$this->fecha');";
										$gg = mysqli_query($link, $sql) or die("error");
										mysqli_close($link);
										*/
										
										$db = new database();
										$db->conectar();
										
										$sql = "INSERT INTO usuario (nombre, contrasena, email, ubicacion, pais, coordenadas, administrador, habilitado, fecha_creacion, denuncias) 
															  VALUES ('$this->nombre', 
															  '$this->contrasena', 
															  '$this->email', 
															  '$this->ubicacion',
															  '$this->pais',
															  '$this->coordenadas', 
															  '$this->administrador', 
															  '$this->habilitado', 
															  '$this->fecha',
															  '$this->denuncias');";
								
										$gg = mysqli_query($db->conexion, $sql) or die("error de registrasdo");
								
										$db->close();
										
										}
	public static function armarUsuario($idUsuario){
		$db = new database();
		$buscUsuario = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
		$this->Usuario = mysqli_query ($this->conexion, $buscUsuario) or die ("Fallo la busqueda del usuario.");
		$db->close();
	}
	
}


?>