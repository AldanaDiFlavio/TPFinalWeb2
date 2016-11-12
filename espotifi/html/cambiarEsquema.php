<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$nuevoFondo = $_REQUEST['nuevoFondo'];
		$nuevoLetras = $_REQUEST['nuevoLetras'];
		$idPlaylist = $_REQUEST['idPlaylist'];

		$db = new BaseDatos();
		
		if($db->conectar()){
			$cambiaFondo = "UPDATE playlist SET colorFondo = '$nuevoFondo' WHERE idPlaylist = $idPlaylist;";
			$resultadoCambiaFondo = mysqli_query( $db->conexion, $cambiaFondo) or die("error al modificar fondo.");
			$cambiaLetras = "UPDATE playlist SET colorLetras = '$nuevoLetras' WHERE idPlaylist = $idPlaylist;";
			$resultadoCambiaLetras = mysqli_query( $db->conexion, $cambiaLetras) or die("error al modificar letras.");
		}
		
		echo "background-color: #$nuevoFondo; color: #$nuevoLetras ";

		
		$db->desconectar();
?>