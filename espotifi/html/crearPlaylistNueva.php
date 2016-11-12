<?php 
	session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Crear nueva Playlist</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript">
		function validaCreacion(){
			var nombre = document.formCrearPlaylist.nombre.value;
			
			if(nombre.length > 0){ 
				document.formCrearPlaylist.accion.disabled = false;
			}
			else { 
				document.formCrearPlaylist.accion.disabled = true;
			}
		}
	</script>
</head>
<body>
	<div class="container" class="acciones">
		<form name="formCrearPlaylist" method = "POST" action = "procesarNuevaPlaylist.php" class="formCrearPlaylist" >				
			Nombre 
			<input id="nombrePlaylist" type = "text" name = "nombre" placeholder="Mi nueva Playlist" maxlength="30" onkeyup="validaCreacion()"/>
			<br><br>
			<input id="submit" type = "submit" name="accion" value = "crear" disabled="disabled"/>		
		</form>	
	</div>

	<footer>
	</footer>

 	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>