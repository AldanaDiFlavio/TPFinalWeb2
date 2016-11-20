<?php


include_once('db.php');

class playlist {
			
			private $idPlaylist;
			
			public function __construct($idPlaylist)
										{
										$this->idPlaylist = $idPlaylist;										
										}
			
		
			public function insertarFoto($nombre){
				$db = new BaseDatos();
				$nombrefoto = substr($nombre,0,-4); 
				if($db->conectar()){
					$insertarFoto = "UPDATE playlist SET fotoPath = 'fotos/". $nombre ."' WHERE idPlaylist = $this->idPlaylist ;";
					mysqli_query( $db->conexion, $insertarFoto) or die("<script type='text/javascript'>alert('Error al insertar la foto nueva.');</script>");	
				}
				$db->desconectar();
			}
			
			public static function purgaPlaylistVacias($idUsuario){
				$db = new BaseDatos();
				if($db->conectar()){
					$buscaPlaylistVacias = "DELETE FROM playlist WHERE idPlaylist NOT IN ( SELECT DISTINCT codPlaylist FROM contiene) AND codDueno = $idUsuario;";
					mysqli_query( $db->conexion, $buscaPlaylistVacias) or die("error al purgar playlist");
				}
				$db->desconectar();
			}
			
			public static function crearPlaylist($codDueno){
					$db = new BaseDatos();
					$date = date('y-m-d');
					if($db->conectar()){
							$consultar = "INSERT INTO playlist (fecha_creacion, codDueno) VALUES ('$date', $codDueno)";
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
			
			public static function todasMisPlaylist($idUsuario, $idUsuarioSession){ //Lista todas las playlist del idUsuario.
				$db = new BaseDatos();
				
				if (isset($_SESSION['admin'])){ $admin = 'true'; } else  $admin = 'false'; 				
					if ($admin == 'false'){ //sino es administrador
						if($db->conectar()){
							if ($idUsuario == $idUsuarioSession){
								$buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion, cantidad_votos FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario AND p.baneo = 0;";
							} else {
								$buscarSiSonSeguidores = "SELECT * FROM sigue WHERE idUsuariojefe = $idUsuario AND idUsuarioSeguidor = $idUsuarioSession;";
								$resultado = mysqli_query( $db->conexion, $buscarSiSonSeguidores) or die("error al buscar si son seguidores.");
								$totalFilas =  mysqli_num_rows($resultado);
								if($totalFilas != 0){
									$buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion, cantidad_votos FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario AND p.baneo = 0 AND e.idEstado != 1;";
								} else $buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion, cantidad_votos FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario AND p.baneo = 0 AND e.idEstado = 3;";
							}
							$resultadoBuscaTodasPlaylistDisponibles = mysqli_query( $db->conexion, $buscaTodasPlaylistDisponibles) or die("error al buscar todas mis Playlist.");
							while($row = mysqli_fetch_assoc($resultadoBuscaTodasPlaylistDisponibles)){
								echo "<b><a href='miPlaylist.php?idPlaylist=". $row["idPlaylist"] ."'>". $row["nombre"] ."</a></b> " . $row["descripcion"] ." (Votos: ". $row["cantidad_votos"] .")<br>";						
							}
							echo "<div id='audio'></div>";
							$db->desconectar();
						}						
					} if ($admin == 'true'){ //si es administador
						
						if($db->conectar()){
							if ($idUsuario == $idUsuarioSession){
								
								$buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion, cantidad_votos, baneo FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario;";
								} else {
										$buscarSiSonSeguidores = "SELECT * FROM sigue WHERE idUsuariojefe = $idUsuario AND idUsuarioSeguidor = $idUsuarioSession;";
										$resultado = mysqli_query( $db->conexion, $buscarSiSonSeguidores) or die("error al buscar si son seguidores.");
										$totalFilas =  mysqli_num_rows($resultado);
										if($totalFilas != 0){
											$buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion, cantidad_votos, baneo FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario;";
										} else $buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion, cantidad_votos, baneo FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario;";
										}
								$resultadoBuscaTodasPlaylistDisponibles = mysqli_query( $db->conexion, $buscaTodasPlaylistDisponibles) or die("error al buscar todas mis Playlist.");
							
							while($row = mysqli_fetch_assoc($resultadoBuscaTodasPlaylistDisponibles)){
								echo "<b><a href='miPlaylist.php?idPlaylist=". $row["idPlaylist"] ."'>". $row["nombre"] ."</a></b> " . $row["descripcion"] ." (Votos: ". $row["cantidad_votos"] .")";									
								if ($row['baneo'] == 1){ 
									echo "<a id='". $row["idPlaylist"] ."' href='#' onclick='banearPlaylist(". $row["idPlaylist"] .")'><span  class='glyphicon glyphicon-eye-close' ></span></a><br>";									
								} else {
									echo "<a id='". $row["idPlaylist"] ."' href='#' onclick='banearPlaylist(". $row["idPlaylist"] .")' ><span  class='glyphicon glyphicon-eye-open' ></span></a><br>";
								}
							}
							
							echo "<div id='audio'></div>";
							$db->desconectar();
						}																				
					}
			}
			
			
			
			
			
			
			public function sumaReproduccion($idUsuario){		
				$db = new BaseDatos();
				
				if($db->conectar()){
					$sumaReproduccion = "UPDATE playlist SET cantidad_reproducciones = cantidad_reproducciones + 1 WHERE idPlaylist = '$this->idPlaylist' AND codDueno != $idUsuario;";
					mysqli_query($db->conexion, $sumaReproduccion);
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
			
			public function eliminarPlaylist(){
				$db = new BaseDatos();
				if($db->conectar()){
					$eliminarPlaylist = "DELETE FROM playlist WHERE idPlaylist = '$this->idPlaylist'";
					mysqli_query( $db->conexion, $eliminarPlaylist) or die("No se pudo eliminar esta Playlist.");
				}
				$db->desconectar();
			}

	}

?>