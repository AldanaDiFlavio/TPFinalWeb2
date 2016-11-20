<?php
	session_start();
	if ($_SESSION['login'] == "on")
		{
		include_once('../clases/db.php');
		
		if(isset($_REQUEST['alerta'])){
			echo "<script type='text/javascript'>alert('". $_REQUEST['alerta'] ."');</script>";
		}
	}else{
			 header('location: ../html/index.php'); 
			 }  
			 
	
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
		
		<form action="FuncionesCancion.php?funcion=subirCancion" method="post" enctype="multipart/form-data">
			<h4>Datos de tu canción</h4>
			<label>Album:</label>
			<input id="album" onkeyup="validaForm()" type="text" name="album"><br>
			<label>Artista:</label>
			<input id="artista" onkeyup="validaForm()" type="text" name="artista"><br>
			<label>Genero:</label>
			<?php
				$db1 = new BaseDatos();
				if($db1->conectar()){
					$buscarGenerosCancion = "SELECT idGenero, descripcion FROM generoCanciones;";
					$generosCanciones = mysqli_query( $db1->conexion, $buscarGenerosCancion) or die("error al buscar los generos de Canciones.");
				}
				echo "<select id='generos' name='generos'>";
				while($row2 = mysqli_fetch_assoc($generosCanciones)){
					echo "<option value='". $row2["idGenero"] ."'>". $row2["descripcion"] ."</option>";
				}
				echo "</select>";
				$db1->desconectar();

			?>
			<input name="file" type="file">
			<input id="submit" type="submit" value="Subir audio" disabled="true">
		</form>
		
	</body>
</html>