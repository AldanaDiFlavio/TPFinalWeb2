<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$generoNuevo = $_GET["generoNuevo"];
		$idPlaylist = $_GET["idPlaylist"];

		$db = new BaseDatos();
		
		if($db->conectar()){
			$buscarIdPlaylist = "UPDATE playlist SET codGenero = '$generoNuevo' WHERE idPlaylist = $idPlaylist;";
			$resultadoIdPlaylist = mysqli_query( $db->conexion, $buscarIdPlaylist) or die("error al modificar genero.");
			$buscaGenero = "SELECT descripcion FROM generoPlaylist WHERE idGenero = $generoNuevo;";
			$resultadoBuscaGenero = mysqli_query( $db->conexion, $buscaGenero) or die("error al buscar genero.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaGenero)){
			echo $row["descripcion"];

		}
		$db->desconectar();
?>