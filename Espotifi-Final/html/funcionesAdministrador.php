<?php
	session_start();
	include_once('../clases/db.php');
	
	
	$funcion = $_REQUEST['funcion'];
	
	if ($funcion == 'banearPerfil'){
		banearPerfil($_REQUEST["idPerfil"]);
	}
	if ($funcion == 'habilitarPerfil'){
		habilitarPerfil($_REQUEST["idPerfil"]);
	}	
	if ($funcion == 'banearPlaylist'){
		banearPlaylist($_REQUEST["idPlaylist"]);
	}
	
	function banearPlaylist($idPlaylist){
		$db = new BaseDatos();
		if($db->conectar()){
			$buscaPlaylist = "SELECT idPlaylist, baneo FROM playlist WHERE idPlaylist = $idPlaylist;";
			$resultado = mysqli_query( $db->conexion, $buscaPlaylist) or die("Error al buscaPlaylist.");
			while($row = mysqli_fetch_assoc($resultado)){	
				if ($row['baneo'] == 0){
					$cambiaEstado = "UPDATE playlist SET baneo = 1 WHERE idPlaylist = $idPlaylist;";
					
				} else {
					$cambiaEstado = "UPDATE playlist SET baneo = 0 WHERE idPlaylist = $idPlaylist;";
				}
				mysqli_query( $db->conexion, $cambiaEstado) or die("Error al buscaPlaylist.");
			}
		$db->desconectar();
		}
	}
	
	function banearPerfil($idPerfil){
		$db = new BaseDatos();
		if($db->conectar()){
			$perfilABanear = "UPDATE usuario SET habilitado = 'false' WHERE idUsuario = $idPerfil;";
			mysqli_query( $db->conexion, $perfilABanear) or die("Error al banear.");
			$limpiaDenuncias = "DELETE FROM denuncias WHERE codDenunciado = $idPerfil;";
			mysqli_query( $db->conexion, $limpiaDenuncias) or die("Error al banear.");		
			
		}
	}
	
	function habilitarPerfil($idPerfil){
		$db = new BaseDatos();
		if($db->conectar()){
			$habilitarPerfil = "UPDATE usuario SET habilitado = 'true' WHERE idUsuario = $idPerfil;";
			mysqli_query( $db->conexion, $habilitarPerfil) or die("Error al banear.");
		
			
		}
	}