<?php
	include_once('db.php');

	class Cancion{
		private $idCancion;

		public function __construct($idCancion){
			$this->idCancion = $idCancion;
		}
		
		public static function insertarCancion($nombre, $album, $artista, $genero, $codDueno){
				$db = new BaseDatos();
				$date = date('y-m-d');
				$nombreCancion = substr($nombre,0,-4); 
				if($db->conectar()){
					$insertarCancion = "INSERT INTO cancion (titulo, album, artista, codDueno, fecha_creacion, path, codGenero) VALUES ('$nombreCancion', '$album', '$artista', $codDueno, '$date', 'canciones/". $nombre ."', $genero);";
					mysqli_query( $db->conexion, $insertarCancion) or die("<script type='text/javascript'>alert('Error al insertar la cancion nueva.');</script>");
					
				}
				$db->desconectar();
			}
			
		public static function todasMisCanciones($idCreador){
			$db = new BaseDatos();
			if($db->conectar()){
				$buscaCanciones = "SELECT c.idCancion, c.titulo, c.album, c.artista FROM cancion c WHERE c.codDueno = $idCreador";
				$resultado = mysqli_query( $db->conexion, $buscaCanciones) or die("error al buscar mis canciones.");
				while($row = mysqli_fetch_assoc($resultado)){
					echo "<a href='miCancion.php?idCancion=". $row["idCancion"] ."'><b>". $row["titulo"] ."</b></a> (". $row["album"] .") de ". $row["artista"] ."<br>";
				}
			}
			$db->desconectar();
		}


		
		
	}
?>