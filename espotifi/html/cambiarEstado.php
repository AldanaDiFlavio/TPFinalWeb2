<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$estadoNuevo = $_GET["estadoNuevo"];
		$idPlaylist = $_GET["idPlaylist"];

		$db = new BaseDatos();
		
		if($db->conectar()){
			$buscarIdPlaylist = "UPDATE playlist SET codEstado = '$estadoNuevo' WHERE idPlaylist = $idPlaylist;";
			$resultadoIdPlaylist = mysqli_query( $db->conexion, $buscarIdPlaylist) or die("error al modificar estado.");
			$buscaEstado = "SELECT descripcion FROM estado WHERE idEstado = $estadoNuevo;";
			$resultadoBuscaEstado = mysqli_query( $db->conexion, $buscaEstado) or die("error al buscar estado.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaEstado)){
			echo $row["descripcion"];

		}
		$db->desconectar();
?>