<?php
	include('db.php');

	class Cancion{
		public $idCancion;
		public $titulo;
		public $album;
		public $artista;
		public $duracion;
		public $codDueño;
		public $fecha_creacion;
		public $baneo;
		public $pathUrl;

		function __construct($idCancion, $titulo, $album, $duracion, $codDueño, $fecha_creacion, $baneo, $pathUrl){
			$this->idCancion = $idCancion;
			$this->titulo = $titulo;
			$this->album = $album;
			$this->artista = $artista;
			$this->duracion = $duracion;
			$this->codDueño = $codDueño;
			$this->fecha_creacion = $fecha_creacion;
			$this->baneo = $baneo;
			$this->pathUrl = $pathUrl;
		}


		function insertarCancion(){
			$db = new BaseDatos();

			if($db->conectar()){
					$consultar = "INSERT INTO cancion (titulo, album, duracion, codDueño, fecha_creacion, baneo, pathUrl) VALUES ('$this->titulo', '$this->album', $this->duracion, $this->codDueño, $this->fecha_creacion, $this->baneo, $this->pathUrl)";

					mysqli_query( $db->conexion, $consultar) or die("No se pudo procesar la consulta");
			}


			$db->desconectar();

		}
	}
?>