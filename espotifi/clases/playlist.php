

<?php

include_once('db.php');

class playlist {
			
			private $idPlaylist;
			
			public function __construct($idPlaylist)
										{
										$this->idPlaylist = $idPlaylist;										
										}
			
			public static function purgaPlaylistVacias($idUsuario){
				$db = new BaseDatos();
				if($db->conectar()){
					$buscaPlaylistVacias = "DELETE FROM playlist WHERE idPlaylist NOT IN ( SELECT DISTINCT codPlaylist FROM contiene) AND codDueno = $idUsuario;";
					mysqli_query( $db->conexion, $buscaPlaylistVacias) or die("error al purgar playlist");
				}
				$db->desconectar();
			}
			
			public static function crearPlaylist($nombre, $codDueno){
					$db = new BaseDatos();
					$date = date('y-m-d');
					if($db->conectar()){
							$consultar = "INSERT INTO playlist (nombre, fecha_creacion, codDueno) VALUES ('$nombre', '$date', $codDueno)";
							mysqli_query( $db->conexion, $consultar) or die("No se pudo conectar.");
					}
					$db->desconectar();
			}
			
			public static function buscarPlaylist(){ //Esta incompleto, falta pasar como parametro el ID del creador, y asi filtrar solo las que le pertenecen a el.
				$db = new BaseDatos();			//Luego en $buscarPlaylist se adisiona al WHERE codDueño = idUsuario.
				if($db->conectar()){
						$buscarPlaylist = "SELECT p.idPlaylist id, p.nombre Nombre, e.descripcion Estado,  p.fecha_creacion Creada FROM playlist p JOIN estado e ON p.codEstado = e.idEstado WHERE baneo = 0;";
						$resultado = mysqli_query( $db->conexion, $buscarPlaylist) or die("No se pudo conectar.");
						echo "<select id='idPlaylistActual' name='idPlaylistActual'>";   
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
						echo "<select id='todasCanciones' name='todasCanciones[]' size='10' multiple>";
						while ($row = mysqli_fetch_assoc($resultado)){    
							echo "<option value='$row[id]'>$row[titulo]</option>";
						}  
						echo "</select>";
						 
			
				}
				$db->desconectar();
			}
			
			public function buscarCancionesEnPlaylist(){ // Busca las canciones contenidas actualmente en el playlist.
				$db = new BaseDatos();			
				if($db->conectar()){
						$buscaCanciones = "SELECT can.idCancion id, can.titulo FROM cancion can JOIN contiene con ON can.idCancion = con.codCancion WHERE baneo = 0 AND con.codPlaylist = $this->idPlaylist;";
						$resultado = mysqli_query( $db->conexion, $buscaCanciones) or die("No se pudo conectar.");
						echo "<select id='cancionesPlaylist' name='cancionesPlaylist[]' size='10' multiple>";
						while ($row = mysqli_fetch_assoc($resultado)){    
							
							echo "<option value='$row[id]'>$row[titulo]</option>";
							  
						}  
						 echo "</select>";
			
				}
				$db->desconectar();
			}
			
			public function buscarCancionesFueraDelPlaylist(){ // Busca todas las canciones que no tenga el playlist.
				$db = new BaseDatos();			
				if($db->conectar()){
						$buscaCanciones = "SELECT DISTINCT can.idCancion id, can.titulo FROM cancion can LEFT JOIN contiene con ON can.idCancion = con.codCancion WHERE baneo = 0 AND can.idCancion NOT IN (SELECT can.idCancion id FROM cancion can JOIN contiene con ON can.idCancion = con.codCancion WHERE baneo = 0 AND con.codPlaylist = $this->idPlaylist);";
						$resultado = mysqli_query( $db->conexion, $buscaCanciones) or die("No se pudo conectar.");
						echo "<select id='cancionesFuera' name='canciones[]' size='10' multiple>";
						while ($row = mysqli_fetch_assoc($resultado)){    
							
							echo "<option value='$row[id]'>$row[titulo]</option>";
							  
						}  
						 echo "</select>";
			
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
						
						
						mysqli_query( $db->conexion, $consultar) or die("No se pudo insertar Estado.");
				}
				$db->desconectar();
			}
			
			public function asignarEsquema($colorFondo, $colorLetras){
				$db = new BaseDatos();
				if($db->conectar()){
						$consultar = "UPDATE playlist SET colorFondo = '$colorFondo' WHERE idPlaylist = '$this->idPlaylist'";
						mysqli_query( $db->conexion, $consultar) or die("No se pudo asignar colorFondo.");
						$consultar = "UPDATE playlist SET colorLetras = '$colorLetras' WHERE idPlaylist = '$this->idPlaylist'";
						mysqli_query( $db->conexion, $consultar) or die("No se pudo asignar colorLetras.");
				}
				$db->desconectar();
			}
			
			public function asignarGenero($codGenero){ 
				$db = new BaseDatos();
				if($db->conectar()){
						$consultar = "UPDATE playlist SET codGenero = '$codGenero' WHERE idPlaylist = '$this->idPlaylist'";
						
						mysqli_query( $db->conexion, $consultar) or die("No se pudo insertar Genero.");
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
			
			public function eliminaCancion($idCancion){
				$db = new BaseDatos();
				if($db->conectar()){
						$borrarCancion = "DELETE FROM contiene WHERE codCancion = '$idCancion' AND codPlaylist = '$this->idPlaylist'";
						if(mysqli_query( $db->conexion, $borrarCancion) or die("No se pudo conectar.")){
								return true;
							} else return false;
						}  
				$db->desconectar();
			}
			
			public function verificaMiPlaylist($idUsuario){ //verifica que el codDueño del Idplaylist del construct sea igual al IdUsuario del parametro.
				
				$db = new BaseDatos();
				if($db->conectar()){
						$buscaPlaylist = "SELECT idPlaylist, codDueno FROM playlist WHERE idPlaylist = '$this->idPlaylist' AND codDueno = $idUsuario";
						if(mysqli_query( $db->conexion, $buscaPlaylist) or die("No se pudo corroborar.")){
								return true;
							} else return false;
						}  
				$db->desconectar();
			}
			
}



?>