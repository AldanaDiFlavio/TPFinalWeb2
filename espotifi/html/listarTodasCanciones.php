<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$idPlaylist = $_GET["idPlaylist"];
		
		$db = new BaseDatos();
		
		if($db->conectar()){
			$cancionesDisponibles = "
			SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion 
			FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero 
			WHERE c.baneo = 0 AND c.idCancion IN ( 
									SELECT DISTINCT codCancion 
									FROM contiene 
									WHERE codCancion NOT IN (
																SELECT codCancion 
																FROM contiene 
																WHERE codPlaylist = $idPlaylist));";
			$resultadoCancionesDisponibles = mysqli_query( $db->conexion, $cancionesDisponibles) or die("error al listar canciones contenidas.");
		}
		echo "
		<tr>
			<th>Titulo </th>
			<th>Artista </th>
			<th>Album </th>
			<th>Genero </th>
		</tr>";
		while($row = mysqli_fetch_assoc($resultadoCancionesDisponibles)){
			echo "
			<tr>
				<td>". $row["titulo"] . "</td> 
				<td>". $row["artista"] . "</td> 
				<td>". $row["album"] . "</td> 
				<td>". $row["descripcion"] . "</td> 
				<td><a onclick='reproduceCancion(" . $row["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
				<td><a onclick='agregarCancionNuevaAPlaylist(" . $row["idCancion"] . ");'><span class='glyphicon glyphicon-plus'></span></a></td>
			</tr>";		
		}	
		echo "</table>";
		
		$db->desconectar();
?>



