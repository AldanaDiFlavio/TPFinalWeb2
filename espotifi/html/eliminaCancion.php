<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$idCancion = $_REQUEST['idCancion'];
		$idPlaylist = $_REQUEST['idPlaylist'];
		
		$playlist = new playlist($idPlaylist);
		if($playlist->eliminaCancion($idCancion)){
			
			$db = new BaseDatos();
			
			if($db->conectar()){
				
				$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero JOIN contiene con ON con.codCancion = c.idCancion WHERE con.codPlaylist = $idPlaylist";
					$resultadobuscarTodasCanciones = mysqli_query( $db->conexion, $buscarTodasCanciones) or die("error al listar las canciones.");
					echo "
					<tr>
								<th>Titulo </th>
								<th>Artista </th>
								<th>Album </th>
								<th>Genero </th>
					</tr>";
					while($row = mysqli_fetch_assoc($resultadobuscarTodasCanciones)){
						echo "
						<tr>
							<td>". $row["titulo"] . "</td> 
							<td>". $row["artista"] . "</td> 
							<td>". $row["album"] . "</td> 
							<td>". $row["descripcion"] . "</td> 
							<td><a onclick='reproduceCancion(" . $row["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
							";
							$playlist = new playlist($idPlaylist);
							if($playlist->verificaMiPlaylist($_SESSION['idUsuario'])){  
								echo "
								<td><a onclick='eliminaCancion(" . $row["idCancion"] . ");'><span class='glyphicon glyphicon-remove'></a>
								";
							}
						echo "</tr>";
					}	
			}
			
			$db->desconectar();
		
		} else echo "error al eliminar esta cancion";
?>