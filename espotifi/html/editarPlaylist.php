<?php
session_start();
	if (!isset($_SESSION['idPlaylistSesion'])){
	$_SESSION['idPlaylistSesion']=$_REQUEST['idPlaylistActual'];}
	include ('../clases/playlist.php');
	
?>

<html>
	<head>	
		
	</head>
	<body>
		
		<?php
        echo "<form method = 'post' action = 'crearPlaylist.php'>";	
		echo "selecciona una o más canciones manteniendo apretada la tecla 'Ctrl'.<br><br>";
		
		
		
		$playlist = new playlist($_SESSION['idPlaylistSesion']);
		$playlist->buscarCancionesEnPlaylist();  
		
		echo "<br><br><input type = 'submit' name='accion' value = 'remover' /></form>";
			
		?>
		<a href="editarPlaylistAgregarCanciones.php">agregar canciones</a>
	</body>
</html>

