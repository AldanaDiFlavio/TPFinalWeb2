<?php
	session_start();
	
	include_once('../clases/db.php');
	include_once('../clases/cancion.php');
	
	$funcion = $_REQUEST['funcion'];
	
	if ($funcion == 'subirCancion'){
		subirCancion();
	}
	if ($funcion == 'cambiarNombre'){
		cambiarNombre($_REQUEST['idCancion'], $_REQUEST['nombreNuevo']);
	}
	if ($funcion == 'cambiarAlbum'){
		cambiarAlbum($_REQUEST['idCancion'], $_REQUEST['albumNuevo']);
	}
	if ($funcion == 'cambiarArtista'){
		cambiarArtista($_REQUEST['idCancion'], $_REQUEST['artistaNuevo']);
	}
	if ($funcion == 'cambiarGenero'){
		cambiarGenero($_REQUEST["generoNuevo"], $_REQUEST["idCancion"]);
	}

	
	function cambiarGenero($generoNuevo, $idCancion){
		$db = new BaseDatos();
		if($db->conectar()){
			$buscarIdCancion = "UPDATE cancion SET codGenero = '$generoNuevo' WHERE idCancion = $idCancion;";
			$resultadoIdCancion = mysqli_query( $db->conexion, $buscarIdCancion) or die("error al modificar genero.");
			$buscaGenero = "SELECT descripcion FROM generoCanciones WHERE idGenero = $generoNuevo;";
			$resultadoBuscaGenero = mysqli_query( $db->conexion, $buscaGenero) or die("error al buscar genero.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaGenero)){
			echo $row["descripcion"];

		}
		$db->desconectar();
	}
	
	function cambiarArtista($idCancion, $artistaNuevo){
		$db = new BaseDatos();
		if($db->conectar()){
			$buscarIdCancion = "UPDATE cancion SET artista = '$artistaNuevo' WHERE idCancion = $idCancion;";
			mysqli_query( $db->conexion, $buscarIdCancion) or die("error al modificar artsta.");
			$buscaNombre = "SELECT artista FROM cancion WHERE idCancion = $idCancion;";
			$resultadoBuscaNombre = mysqli_query( $db->conexion, $buscaNombre) or die("error al buscar artsta.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaNombre)){
			echo $row["artista"];
		}
		$db->desconectar();
	}
		
	function cambiarNombre($idCancion, $nombreNuevo){
		$db = new BaseDatos();
		if($db->conectar()){
			$buscarIdCancion = "UPDATE cancion SET titulo = '$nombreNuevo' WHERE idCancion = $idCancion;";
			mysqli_query( $db->conexion, $buscarIdCancion) or die("error al modificar nombre.");
			$buscaNombre = "SELECT titulo FROM cancion WHERE idCancion = $idCancion;";
			$resultadoBuscaNombre = mysqli_query( $db->conexion, $buscaNombre) or die("error al buscar nombre.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaNombre)){
			echo $row["titulo"];
		}
		$db->desconectar();
	}
	
	function cambiarAlbum($idCancion, $albumNuevo){
		$db = new BaseDatos();
		if($db->conectar()){
			$buscarIdCancion = "UPDATE cancion SET album = '$albumNuevo' WHERE idCancion = $idCancion;";
			mysqli_query( $db->conexion, $buscarIdCancion) or die("error al modificar album.");
			$buscaNombre = "SELECT album FROM cancion WHERE idCancion = $idCancion;";
			$resultadoBuscaNombre = mysqli_query( $db->conexion, $buscaNombre) or die("error al buscar album.");
		}
		while($row = mysqli_fetch_assoc($resultadoBuscaNombre)){
			echo $row["album"];
		}
		$db->desconectar();
	}
	
	
	
	function subirCancion(){
		$name = $_FILES['file']['name'];
		$extension = strtolower(substr($name, strpos($name, '.')+1));
		$type = $_FILES['file']['type'];
		$size = $_FILES['file']['size'];
		$max_size = 8388608; //hasta 8MB = 8388608 bytes
		$tmp_name = $_FILES['file']['tmp_name'];

		if(isset($name)){
			if(!empty($name)){
				$location = "../canciones/" . basename($name);
				
				if(($extension == 'mp3' || $extension == 'MP3') && ($type == 'audio/mp3' || $type == 'audio/MP3')){
						if($size <= $max_size){
						if(move_uploaded_file($tmp_name, $location)){
						cancion::insertarCancion($name, $_REQUEST['album'], $_REQUEST['artista'],$_REQUEST['generos'], $_SESSION['idUsuario']);
						echo $name, $extension, $type, $size; 
						header("location: home.php?idUsuario=". $_SESSION["idUsuario"] ."") ; 
						}
					}
					else{
						$alerta = "Debe ser menor a 8 MB.";
						header("location: subirCancionNueva.php?alerta=". $alerta ."") ; 
					}
					
				}
				else{
					$alerta = "Debe ser formato mp3 o MP3.";
					header("location: subirCancionNueva.php?alerta=". $alerta ."") ; 
				}

			}
			else{
				$alerta = "Por favor seleccione un archivo.";
				
				header("location: subirCancionNueva.php?alerta=". $alerta .""); 
			}
		}
		
	}
	
	
	



?>