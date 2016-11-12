<?php
	include_once('../clases/db.php');
	
	$tipoFiltro = $_GET["tipoFiltro"];
	$cancionesListadas = $_GET["cancionesListadas"];
	
	$db = new BaseDatos();
		if($db->conectar()){
			if ($tipoFiltro != 'descripcion'){
			$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero WHERE c.$tipoFiltro = '$cancionesListadas'";
			} else {
			$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero WHERE gc.$tipoFiltro = '$cancionesListadas'";	
			}
			$resultadobuscarTodasCanciones = mysqli_query( $db->conexion, $buscarTodasCanciones) or die("error al listar las canciones.");
			echo "
			<tr>
						<th>Titulo</th>
						<th>Artista</th>
						<th>Album</th>
						<th>Genero</th>
			</tr>";
			
			while($row = mysqli_fetch_assoc($resultadobuscarTodasCanciones)){
				echo "
				<tr>
					<th>". $row["titulo"] ."</th> 
					<th>". $row["artista"] ."</th> 
					<th>". $row["album"] . "</th> 
					<th>". $row["descripcion"] ."</th> 
				<th><input type='checkbox' name='cancionesSeleccionadas[]' value=". $row["idCancion"] ." onclick='validaCreacion()'><br></th>
				</tr>";
			}
		}	
	
	$db->desconectar();
?>
