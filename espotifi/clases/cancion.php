<?php
	include_once('db.php');

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
		
		public static function buscarCanciones($filtroContenido, $filtroTipo){ //Busca canciones a partir de un filtro
				$db = new BaseDatos();			
				if($db->conectar()){
							$buscaCanciones = "SELECT idCancion id, titulo, album, artista FROM cancion WHERE baneo = 0 AND $filtroTipo = '$filtroContenido';";
							$resultado = mysqli_query( $db->conexion, $buscaCanciones) or die("No se pudo conectar.");
							echo "<select id='todasCanciones' name='todasCanciones[]' size='10' multiple>";
							while ($row = mysqli_fetch_assoc($resultado)){    
								echo "<option value='$row[id]'>$row[titulo] | $row[album] | $row[artista]</option>";
							}  
							echo "</select>";
						
				}
				$db->desconectar();
			}
		
		
	}
?>