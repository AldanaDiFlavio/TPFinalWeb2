<?php
session_start();
	include ('../clases/playlist.php');
?>

<html>
	<head>	
	<title>Editar Playlist</title>
	</head>
	<body>
		<form action="editarPlaylist.php" method="post">	
			Editar playlist: 
			<?php
				playlist::buscarPlaylist();
			?>
			<input type = "submit" name="accion" value = "editar" />		
		</form>	
	</body>
</html>

