<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$idCancionNueva = $_GET["idCancionNueva"];
		$idPlaylist = $_GET["idPlaylist"];
		
		
		
		$playlist = new playlist($idPlaylist);
		$playlist->agregarCancion($idCancionNueva);   
		
		$db1 = new BaseDatos();
		
		if($db1->conectar()){
						$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero JOIN contiene con ON con.codCancion = c.idCancion WHERE con.codPlaylist = $idPlaylist";
						$resultadobuscarTodasCanciones = mysqli_query( $db1->conexion, $buscarTodasCanciones) or die("error al listar las canciones.");
						$codDueno = "SELECT codDueno FROM playlist WHERE idPlaylist = $idPlaylist";
						$resultadoCodDueno = mysqli_query( $db1->conexion, $codDueno) or die("error al buscar codDueno.");
						while($rowA = mysqli_fetch_assoc($resultadoCodDueno)){
						echo "
						<tr>
								<th>Titulo </th>
								<th>Artista </th>
								<th>Album </th>
								<th>Genero </th>
						</tr>";
						while($row1 = mysqli_fetch_assoc($resultadobuscarTodasCanciones)){
							echo "
							<tr>
								<td>". $row1["titulo"] . "</td> 
								<td>". $row1["artista"] . "</td> 
								<td>". $row1["album"] . "</td> 
								<td>". $row1["descripcion"] . "</td> 
								<td><a onclick='reproduceCancion(" . $row1["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
								";
								if ($rowA["codDueno"] == $_SESSION['idUsuario']){
									echo "
									<td><a onclick='eliminaCancion(" . $row1["idCancion"] . ");'><span class='glyphicon glyphicon-remove'></a>
									";
								}
							echo "
							</tr>";
						}
					}
		}