<?php
	session_start();
	if ($_SESSION['login'] == "on")
		{
		include_once('../clases/db.php');
	
		if(isset($_REQUEST['alerta'])){
			echo "<script type='text/javascript'>alert('". $_REQUEST['alerta'] ."');</script>";
		}
		}
		else{
			 header('location: ../html/index.php'); 
			 }  
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Importar Playlist</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
</head>
	<body>
		
		<form action="funcionesHome.php?funcion=importarPlaylist&idUsuario=<?php echo "". $_SESSION['idUsuario'] .""; ?>" method="post" enctype="multipart/form-data">
			<h4>Importar una playlist nueva</h4>
			
			<input name="file" type="file" /><input id="submit" type="submit" value="importar" /><br><br>
			<?php 
				echo "<a href='home.php?idUsuario=". $_SESSION['idUsuario'] ."'><input id='volver' type='button' value='volver' ></input></a>";
			?>
		</form>
		<object type="application/x-shockwave-flash" width="400" height="170"
		data="xspf_player.swf?playlist_url=<?php echo $_REQUEST['location'] ?>">
		<param name="movie" 
		value="xspf_player.swf?playlist_url=playlist.xspf" />
		</object>
	</body>
</html>