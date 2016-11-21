<?php
	session_start();
	include_once('../clases/db.php');
	include_once('../clases/playlist.php');
	
	$funcion = $_REQUEST['funcion'];
	
	if ($funcion == 'realizarBusqueda'){
		realizarBusqueda($_REQUEST["idUsuario"], $_REQUEST["filtroPrimario"], $_REQUEST["filtroSecundario"], $_REQUEST["textoBuscado"]);
	}
	if ($funcion == 'crearPlaylistNueva'){
		crearPlaylistNueva($_SESSION['idUsuario']);
	}
	if ($funcion == 'seguir'){
		seguir($_REQUEST["valorSeguir"], $_REQUEST["idJefe"], $_REQUEST["idSeguidor"]);	
	}
	if ($funcion == 'denunciar'){
		denunciar($_REQUEST["motivo"], $_REQUEST["denunciado"]);	
	}

	
	function realizarBusqueda($idUsuario, $filtroPrimario, $filtroSecundario, $textoBuscado){	

		$db = new BaseDatos();
		
		if($db->conectar()){
			if ($filtroPrimario == 'filtroUsuario'){
				$busqueda = "SELECT idUsuario, nombre FROM usuario WHERE nombre = '$textoBuscado' AND habilitado = 'true'";
				$resultadoBusqueda = mysqli_query( $db->conexion, $busqueda) or die("error al buscar usuario.");
				
				while($row = mysqli_fetch_assoc($resultadoBusqueda)){
					echo "
					 
						<b><a href='home.php?idUsuario=". $row["idUsuario"] ."'>". $row["nombre"] ."</a><br></b>
						
					";
				}
				
			} 
			
			if ($filtroPrimario == 'filtroPlaylist' AND $filtroSecundario == 'nombre'){
				$patron = 'p.nombre';
			}
			if ($filtroPrimario == 'filtroPlaylist' AND $filtroSecundario == 'genero'){
				$patron = 'gp.descripcion';
			}
			if ($filtroPrimario == 'filtroPlaylist' AND $filtroSecundario == 'creador'){
				$busqueda = "SELECT p.idPlaylist, p.nombre nombrep, gp.descripcion genero, e.descripcion estado, u.nombre nombre, p.codDueno
						FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero JOIN estado e ON e.idEstado = p.codEstado JOIN usuario u ON u.idUsuario = p.codDueno
						WHERE u.nombre LIKE '$textoBuscado' AND p.baneo = 0 AND u.habilitado LIKE 'true' AND (p.codEstado = 3 OR p.codDueno IN (SELECT idUsuarioJefe FROM sigue WHERE idUsuarioSeguidor = ". $_SESSION['idUsuario'] .") AND p.codEstado != 1 );";	
						
				$resultadoBusqueda = mysqli_query( $db->conexion, $busqueda) or die("error al buscar playlist por nombre/genero.");
				
				while($row = mysqli_fetch_assoc($resultadoBusqueda)){
					echo "
						<b><a href='miPlaylist.php?idPlaylist=". $row["idPlaylist"] ."'>". $row["nombrep"] ."</a></b>   
						 ". $row["genero"] ."
						 ". $row["estado"] ." de <b><a href='home.php?idUsuario=". $row["codDueno"] ."'>". $row["nombre"] ."</a></b><br>";
				}
			}
			if (isset($patron)){
				
				$busqueda = "SELECT p.idPlaylist, p.nombre, gp.descripcion genero, e.descripcion estado, u.nombre nombreU, p.codDueno
						FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero JOIN estado e ON e.idEstado = p.codEstado JOIN usuario u ON u.idUsuario = p.codDueno 
						WHERE ". $patron ." = '$textoBuscado' AND baneo = 0 AND (p.codEstado = 3 OR p.codDueno IN (SELECT idUsuarioJefe FROM sigue WHERE idUsuarioSeguidor = ". $_SESSION['idUsuario'] ."));";	
						
				$resultadoBusqueda = mysqli_query( $db->conexion, $busqueda) or die("error al buscar playlist por nombre/genero.");
				
				while($row = mysqli_fetch_assoc($resultadoBusqueda)){
					echo "
						<b><a href='miPlaylist.php?idPlaylist=". $row["idPlaylist"] ."'>". $row["nombre"] ."</a></b>   
						 ". $row["genero"] ."
						 ". $row["estado"] ." de <b><a href='home.php?idUsuario=". $row["codDueno"] ."'>". $row["nombreU"] ."</a></b><br>";
				}
				
			} 
						
		}	
	
		$db->desconectar();
	}
	
	function crearPlaylistNueva($idUsuario){
		playlist::crearPlaylist($idUsuario);
		
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
	}
	
	function seguir($valorSeguir, $idJefe, $idSeguidor){ //falta		
		$db = new BaseDatos();		
		if($db->conectar()){
			if($valorSeguir == 0){
				$deleteSeguidor = "DELETE FROM sigue WHERE idUsuarioJefe = $idJefe AND idUsuarioSeguidor = $idSeguidor;";
				mysqli_query( $db->conexion, $deleteSeguidor) or die("error al deletear seguidor.");
			}
			if($valorSeguir == 1){
				$insertSeguidor = "INSERT INTO sigue (idUsuarioJefe, idUsuarioSeguidor, estado) values ($idJefe, $idSeguidor, 0);";
				mysqli_query( $db->conexion, $insertSeguidor) or die("error al insertar seguidor.");
			}
		}		
		$db->desconectar();		
	}
	
	function denunciar($motivo, $denunciado){
		$db = new BaseDatos();		
		if($db->conectar()){		
			$verificarDenuncias = "SELECT codDenunciado FROM denuncias WHERE codDenunciado = $denunciado AND codDenunciador = ". $_SESSION['idUsuario'] .";";
			$consulta = mysqli_query( $db->conexion, $verificarDenuncias) or die("error al buscar denuncias.");

			if (mysqli_num_rows($consulta) != 0){
				echo "Tu denuncia anterior aún esta pendiente.";
			} else {
				$insertarDenuncia = "INSERT INTO denuncias (codDenunciado, codDenunciador, codMotivo) VALUES ($denunciado, ". $_SESSION['idUsuario'] .", $motivo);";
				mysqli_query( $db->conexion, $insertarDenuncia) or die("error al insertar denuncia.");
				echo "Denuncia recibida, pendiente de revision.";
			}
		}	
		$db->desconectar();	
	}

	
	
	
?>