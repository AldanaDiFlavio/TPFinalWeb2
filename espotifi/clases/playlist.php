<?php
include('../clases/db.php');

class playlist {
			
			private $idPlaylist;
			
			public function __construct($idPlaylist)
										{
										$this->idPlaylist = $idPlaylist;										
										}
			
			public static function crearPlaylist($nombre){
				$db = new BaseDatos();
				$date = date('y-m-d');
				if($db->conectar()){
						$consultar = "INSERT INTO playlist (nombre, fecha_creacion) VALUES ('$nombre', '$date')";
						mysqli_query( $db->conexion, $consultar) or die("No se pudo conectar.");
				}
				$db->desconectar();
			}
			
			public static function buscarPlaylist(){ //Esta incompleto, falta pasar como parametro el ID del creador, y asi filtrar solo las que le pertenecen a el.
				$db = new BaseDatos();			//Luego en $buscarPlaylist se adisiona al WHERE codDueño = idUsuario.
				if($db->conectar()){
						$buscarPlaylist = "SELECT p.idPlaylist id, p.nombre Nombre, e.descripcion Estado,  p.fecha_creacion Creada FROM playlist p JOIN estado e ON p.codEstado = e.idEstado WHERE baneo = 0;";
						$resultado = mysqli_query( $db->conexion, $buscarPlaylist) or die("No se pudo conectar.");
						echo "<select name='playlist'>";   
						while ($row = mysqli_fetch_assoc($resultado)){    
							echo "<option value='$row[id]'>$row[Nombre] $row[Estado]</option>";    
						}  
						echo "</select> ";  
			
				}
				$db->desconectar();
			}
			
			public static function buscarCanciones(){ // Este metodo es auxiliar, ya que no pertenece a la clase Playlist.
				$db = new BaseDatos();			
				if($db->conectar()){
						$buscaCanciones = "SELECT idCancion id, titulo, album, artista, duracion FROM cancion WHERE baneo = 0;";
						$resultado = mysqli_query( $db->conexion, $buscaCanciones) or die("No se pudo conectar.");
						
						while ($row = mysqli_fetch_assoc($resultado)){    
							echo "<input type='checkbox' name='check_list[]' value='$row[id]'>$row[titulo]</input><br>";    
						}  
						 
			
				}
				$db->desconectar();
			}
			
			
			public function agregarCancion($codCancion){
				$db = new BaseDatos();
				if($db->conectar()){
						$consultar = "INSERT INTO contiene (codPlaylist, codCancion) VALUES ('$this->idPlaylist', '$codCancion')";
						mysqli_query( $db->conexion, $consultar) or die("Algunas canciones seleccionadas ya estan en el setlist.");
				}
				$db->desconectar();
			}
			
			public function asignarEstado($codEstado){
				$db = new BaseDatos();
				if($db->conectar()){
						$consultar = "UPDATE playlist SET codEstado = '$codEstado' WHERE idPlaylist = '$this->idPlaylist'";
						mysqli_query( $db->conexion, $consultar) or die("No se pudo conectar.");
				}
				$db->desconectar();
			}
			
			public function asignarEsquema($codEsquema){
				$db = new BaseDatos();
				if($db->conectar()){
						$consultar = "UPDATE playlist SET codEsquema = '$codEsquema' WHERE idPlaylist = '$this->idPlaylist'";
						mysqli_query( $db->conexion, $consultar) or die("No se pudo conectar.");
				}
				$db->desconectar();
			}
			
			public function asignarGenero($codGenero){ 
				$db = new BaseDatos();
				if($db->conectar()){
						$consultar = "INSERT INTO pertenece (codElemento, codGenero) VALUES ('$this->idPlaylist', '$codGenero')";
						mysqli_query( $db->conexion, $consultar) or die("No se pudo conectar.");
				}
				$db->desconectar();
			}
	
			public static function listarGenerosPlaylist(){
				$db = new BaseDatos();
				if($db->conectar()){
						$buscaGeneros = "SELECT idGenero id, descripcion FROM genero;";
						$resultado = mysqli_query( $db->conexion, $buscaGeneros) or die("No se pudo conectar.");
						echo "<select name='generos'>";   
						while ($row = mysqli_fetch_assoc($resultado)){    
							echo "<option value='$row[id]'>$row[descripcion]</option>";    
						}  
						echo "</select> ";  
				}
				$db->desconectar();
			}
			
			public static function topCinco(){
				$db = new BaseDatos();
				if($db->conectar()){
					$buscarCincoMejores = "SELECT nombre, cantidad_votos FROM playlist ORDER BY cantidad_votos DESC LIMIT 0,5;";
					$resultado = mysqli_query( $db->conexion, $buscarCincoMejores) or die("No se pudo conectar.");

						while ($row = mysqli_fetch_assoc($resultado)){    
							echo "'$row[nombre]'<br>";    
						}  
						  
					
					
					
				}
				$db->desconectar();
			}
			
}



?>