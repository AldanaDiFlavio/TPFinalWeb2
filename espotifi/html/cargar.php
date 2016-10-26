<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Canciones</title>
</head>
	<body>
		<p>Subir canción</p>
		<form action="../php/subirCancion.php" method="post" enctype="multipart/form-data">
			<!-- <label>Titulo:</label>
			<input type="text" name="titulo"><br>
			<label>Album:</label>
			<input type="text" name="album"><br>
			<label>Artista:</label>
			<input type="text" name="artista"><br>
			<label>Duracion:</label>
			<input type="text" name="duracion" disabled><br> <!-- esta bloquedo el campo para no insertar nada deberia aparecer la duracion de la cancion -->
			<input name="file" type="file">
			<input type="submit" value="Subir audio">
		</form>
	</body>
</html>