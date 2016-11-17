<?php 
	session_start(); 
	$idCancion = $_REQUEST["idCancion"];
	include_once('../clases/db.php');
	include_once('../clases/cancion.php');
	
	
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi Playlist</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript" src="javaScript/funcionesCancion.js"></script>
</head>
<body>
	<div id="container" class="container" class="acciones" >
					
			<?php
				$db = new BaseDatos();
				if($db->conectar()){
					$buscarCancion = "SELECT c.titulo, c.album, c.artista, c.fecha_creacion, gc.descripcion, c.path FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero WHERE c.idCancion = $idCancion";
					$resultadoBuscarCancion = mysqli_query( $db->conexion, $buscarCancion) or die("error al buscar la cancion.");
				}
				while($row = mysqli_fetch_assoc($resultadoBuscarCancion)){
					echo "titulo <b><span id='nombre'>". $row['titulo'] ."</span></b>";
					echo "<a href='#' onclick='editarElemento(nombreNuevo,nombreNuevoOk);' ><span class='glyphicon glyphicon-pencil' /></a><input id='nombreNuevo' type='text' style='display:none;' value='". $row['titulo'] ."'></input><a  id='nombreNuevoOk'  href='#' onclick='cambiarNombre(". $idCancion .");' style='display:none;'><span onclick='editarElemento(nombreNuevo,nombreNuevoOk);' class='glyphicon glyphicon-ok' /></a><br>";	
					
					echo "Album <b><span id='album'>". $row['album'] ."</span></b>";
					echo "<a href='#' onclick='editarElemento(albumNuevo,albumNuevoOk);' ><span class='glyphicon glyphicon-pencil' /></a><input id='albumNuevo' type='text' style='display:none;' value='". $row['album'] ."'></input><a  id='albumNuevoOk'  href='#' onclick='cambiarAlbum(". $idCancion .");' style='display:none;'><span onclick='editarElemento(albumNuevo,albumNuevoOk);' class='glyphicon glyphicon-ok' /></a><br>";

					echo "Artista <b><span id='artista'>". $row['artista'] ."</span></b>";
					echo "<a href='#' onclick='editarElemento(artistaNuevo,artistaNuevoOk);' ><span class='glyphicon glyphicon-pencil' /></a><input id='artistaNuevo' type='text' style='display:none;' value='". $row['artista'] ."'></input><a  id='artistaNuevoOk'  href='#' onclick='cambiarArtista(". $idCancion .");' style='display:none;'><span onclick='editarElemento(artistaNuevo,artistaNuevoOk);' class='glyphicon glyphicon-ok' /></a><br>";

					echo "Genero <b><span id='genero'>". $row['descripcion'] ."</span></b>";
					echo "<a href='#' onclick='editarElemento(generoNuevo,generoNuevoOk);'><span class='glyphicon glyphicon-pencil'></a>";
					$db1 = new BaseDatos();
					if($db1->conectar()){	
						$buscarGenerosCanciones = "SELECT idGenero, descripcion FROM generoCanciones;";
						$generosCanciones = mysqli_query( $db1->conexion, $buscarGenerosCanciones) or die("error al buscar los generos de canciones.");
					}
					echo "<select id='generoNuevo' name='generoNuevo' style='display:none;'>";
					while($row2 = mysqli_fetch_assoc($generosCanciones)){
						echo "<option value='". $row2["idGenero"] ."'>". $row2["descripcion"] ."</option>";
					}
					echo "</select>";
					echo "<a id='generoNuevoOk' href='#' onclick='cambiarGenero(". $idCancion .");' style='display:none;'><span onclick='editarElemento(generoNuevo,generoNuevoOk);' class='glyphicon glyphicon-ok'></a>";

					$db1->desconectar();

					echo "<br>Fecha de carga <b>". $row['fecha_creacion'] ."</b>";
					
					echo "<br><audio id='sonido' src='../". $row['path'] ."' controls></audio><br><br>";
				}
	
				$db->desconectar();
				
				
			
				echo "<a href='home.php?idUsuario=". $_SESSION['idUsuario'] ."'><input id='volver' type='button' value='volver' ></input></a>";
				
				
			?>	
			
		
			
		
	</div>

	<footer>
	</footer>

 	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>