<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$nombreNuevo = $_GET["nombreNuevo"];
		$idPlaylist = $_GET["idPlaylist"];
		
		$db = new BaseDatos();
		
		if($db->conectar()){
			$buscarIdPlaylist = "UPDATE playlist SET nombre = '$nombreNuevo' WHERE idPlaylist = $idPlaylist;";
			$resultadoIdPlaylist = mysqli_query( $db->conexion, $buscarIdPlaylist) or die("error al modificar nombre.");
			$buscaNombre = "SELECT nombre FROM playlist WHERE idPlaylist = $idPlaylist;";
			$resultadoBuscaNombre = mysqli_query( $db->conexion, $buscaNombre) or die("error al buscar nombre.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaNombre)){
			echo $row["nombre"];

		}
		$db->desconectar();
?>