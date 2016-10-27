<?php
	session_start();
	include_once ('../clases/cancion.php');
	include_once ('../clases/playlist.php');
	
	
?>



<html>
	<head>	
		
	</head>
	<body>
		
		<form method = "post" action = "editarPlaylistAgregarCanciones.php">	
			Buscar:
			<input name="filtroContenido" type="text"></input>
			<input type="radio" name="filtroTipo" value="titulo" checked="checked" > titulo
			<input type="radio" name="filtroTipo" value="album"> album
			<input type="radio" name="filtroTipo" value="artista"> artista
			<input type="submit" name="buscar" value="buscar"></input>
			
			<br>
			<?php
			if (isset($_POST['buscar'])){
				echo "<br>";
				cancion::buscarCanciones($_REQUEST['filtroContenido'], $_REQUEST['filtroTipo']); 
				echo "<br><input type='submit' name='agregar' value='agregar'></input>";
			} 
			if (isset($_POST['agregar'])){
				$db = new BaseDatos();
				if($db->conectar()){							
					if(!empty($_REQUEST['todasCanciones'])){
								$cancionesSeleccionadas = $_REQUEST['todasCanciones'];
								foreach($cancionesSeleccionadas as $canciones) {
									$playlist = new playlist($_SESSION['idPlaylistSesion']);
									$playlist->agregarCancion($canciones);
								}
							}			  
				}
				$db->desconectar();
				if ($_REQUEST['todasCanciones'] <> NULL){
				echo "<br>";
				echo "<br><input type='submit' name='agregar' value='agregar'></input>";}
			} 
			
			
			
			
			?>
			<a href="editarPlaylist.php" value="volver">volver</a>
		</form>	
	</body>
</html>