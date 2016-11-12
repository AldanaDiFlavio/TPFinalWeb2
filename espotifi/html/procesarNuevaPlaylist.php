<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		$idUsuario = $_SESSION['idUsuario'];
		playlist::crearPlaylist($_REQUEST['nombre'], $idUsuario);
		
		$db = new BaseDatos();
		
		if($db->conectar()){
			$buscarIdPlaylist = "SELECT idPlaylist FROM playlist ORDER BY idPlaylist DESC LIMIT 1;";
			$resultadoIdPlaylist = mysqli_query( $db->conexion, $buscarIdPlaylist) or die("error al buscar el ID de la Playlist.");
		}
		while($row = mysqli_fetch_assoc($resultadoIdPlaylist)){
			$idPlaylist = $row["idPlaylist"];
		}

		$db->desconectar();
		
		header("location: miPlaylist.php?idPlaylist=$idPlaylist") ; 
?>