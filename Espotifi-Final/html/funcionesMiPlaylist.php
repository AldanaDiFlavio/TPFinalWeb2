<?php
	session_start();
	include_once('../clases/db.php');
	include_once('../clases/playlist.php');
	
	$funcion = $_REQUEST['funcion'];
	
	if ($funcion == 'cambiarNombre'){
		cambiarNombre($_REQUEST["nombreNuevo"], $_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'cambiarGenero'){
		cambiarGenero($_REQUEST["generoNuevo"], $_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'cambiarEstado'){
		cambiarEstado($_REQUEST["estadoNuevo"], $_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'cambiarEsquema'){
		cambiarEsquema($_REQUEST["nuevoFondo"], $_REQUEST["nuevoLetras"], $_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'eliminaCancion'){
		eliminaCancion($_REQUEST["idCancion"], $_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'listarTodasCanciones'){
		listarTodasCanciones($_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'agregarCancionNuevaAPlaylist'){
		agregarCancionNuevaAPlaylist($_REQUEST["idCancionNueva"], $_REQUEST["idPlaylist"]);
	}
	
	if ($funcion == 'votar'){
		votar($_REQUEST["valorVoto"], $_REQUEST["idPlaylist"], $_REQUEST["idUsuario"]);
		echo $valorVoto;
	}
	
	if ($funcion == 'eliminarPlaylist'){
		
		eliminarPlaylist($_REQUEST["idPlaylist"]);
	}
	if ($funcion == 'subirFoto'){
		subirFoto($_REQUEST['idPlaylist']);
	}

	
	function cambiarNombre($nombreNuevo, $idPlaylist){
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
	}
	
	function cambiarGenero($generoNuevo, $idPlaylist){
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
	}
	
	function cambiarEstado($estadoNuevo, $idPlaylist){
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
	}
	
	function cambiarEsquema($nuevoFondo, $nuevoLetras, $idPlaylist){
		$db = new BaseDatos();		
		if($db->conectar()){
			$cambiaFondo = "UPDATE playlist SET colorFondo = '$nuevoFondo' WHERE idPlaylist = $idPlaylist;";
			$resultadoCambiaFondo = mysqli_query( $db->conexion, $cambiaFondo) or die("error al modificar fondo.");
			$cambiaLetras = "UPDATE playlist SET colorLetras = '$nuevoLetras' WHERE idPlaylist = $idPlaylist;";
			$resultadoCambiaLetras = mysqli_query( $db->conexion, $cambiaLetras) or die("error al modificar letras.");
		}		
		echo "background-color: #$nuevoFondo; color: #$nuevoLetras ";
		$db->desconectar();
	}
	
	function eliminaCancion($idCancion, $idPlaylist){
		$playlist = new playlist($idPlaylist);
		$idUsuario = $_SESSION['idUsuario'];
		if($playlist->eliminaCancion($idCancion, $idPlaylist)){	
			$db = new BaseDatos();
			if($db->conectar()){				
				$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero JOIN contiene con ON con.codCancion = c.idCancion WHERE con.codPlaylist = $idPlaylist";
				$resultadobuscarTodasCanciones = mysqli_query( $db->conexion, $buscarTodasCanciones) or die("error al listar las canciones.");
				echo "
				<tr>
						<th>Titulo </th>
							<th>Artista </th>
							<th>Album </th>
							<th>Genero </th>
				</tr>";
				while($row = mysqli_fetch_assoc($resultadobuscarTodasCanciones)){
					echo "
					<tr>
						<td>". $row["titulo"] . "</td> 
						<td>". $row["artista"] . "</td> 
						<td>". $row["album"] . "</td> 
						<td>". $row["descripcion"] . "</td> 
						<td><a onclick='reproduceCancion(" . $row["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
						";
						$playlist = new playlist($idPlaylist);  
						if($playlist->verificaMiPlaylist($idUsuario)){  
							echo "
							<td><a onclick='eliminaCancion(" . $row["idCancion"] . ",". $idPlaylist .");'><span class='glyphicon glyphicon-remove'></a>
							";
						}
					echo "</tr>";
				}	
			}
			$db->desconectar();
		} else echo "error al eliminar esta cancion";
	}
	
	function listarTodasCanciones($idPlaylist){
		$db = new BaseDatos();
		if($db->conectar()){
			$cancionesDisponibles = "
			SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion 
			FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero 
			WHERE c.baneo = 0 AND c.idCancion NOT IN ( SELECT codCancion FROM contiene WHERE codPlaylist = $idPlaylist);";
			$resultadoCancionesDisponibles = mysqli_query( $db->conexion, $cancionesDisponibles) or die("error al listar canciones contenidas.");
		}
		echo "
		<tr>
			<th>Titulo </th>
			<th>Artista </th>
			<th>Album </th>
			<th>Genero </th>
		</tr>";
		while($row = mysqli_fetch_assoc($resultadoCancionesDisponibles)){
			echo "
			<tr>
				<td>". $row["titulo"] . "</td> 
				<td>". $row["artista"] . "</td> 
				<td>". $row["album"] . "</td> 
				<td>". $row["descripcion"] . "</td> 
				<td><a onclick='reproduceCancion(" . $row["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
				<td><a onclick='agregarCancionNuevaAPlaylist(" . $row["idCancion"] . ",". $idPlaylist .");'><span class='glyphicon glyphicon-plus'></span></a></td>
			</tr>";		
		}	
		echo "</table>";
		$db->desconectar();
	}
	
	function agregarCancionNuevaAPlaylist($idCancionNueva, $idPlaylist){
		$playlist = new playlist($idPlaylist);
		$playlist->agregarCancion($idCancionNueva);   
		$idUsuario = $_SESSION["idUsuario"];
		$db1 = new BaseDatos();		
		if($db1->conectar()){
			$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero JOIN contiene con ON con.codCancion = c.idCancion WHERE con.codPlaylist = $idPlaylist";
			$resultadobuscarTodasCanciones = mysqli_query( $db1->conexion, $buscarTodasCanciones) or die("error al listar las canciones.");
			$codDueno = "SELECT codDueno FROM playlist WHERE idPlaylist = $idPlaylist";
			$resultadoCodDueno = mysqli_query( $db1->conexion, $codDueno) or die("error al buscar codDueno.");
			while($rowA = mysqli_fetch_assoc($resultadoCodDueno)){
				echo "
				<tr>
					<th>Titulo </th>
					<th>Artista </th>
					<th>Album </th>
					<th>Genero </th>
				</tr>";
				while($row1 = mysqli_fetch_assoc($resultadobuscarTodasCanciones)){
					echo "
						<tr>
							<td>". $row1["titulo"] . "</td> 
							<td>". $row1["artista"] . "</td> 
							<td>". $row1["album"] . "</td> 
							<td>". $row1["descripcion"] . "</td> 
							<td><a onclick='reproduceCancion(" . $row1["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
							";
					if ($rowA["codDueno"] == $idUsuario){
						echo "
							<td><a onclick='eliminaCancion(" . $row1["idCancion"] . ", " . $idPlaylist . ");'><span class='glyphicon glyphicon-remove'></a>
							";
					}
					echo "
						</tr>";
				}
			}
		}
	}
	
	function votar($valorVoto, $idPlaylist, $idUsuario){
		$db = new BaseDatos();		
		if($db->conectar()){
			if($valorVoto == 0){
				$deleteVota = "DELETE FROM vota WHERE codPlaylist = $idPlaylist AND codUsuario = $idUsuario;";
				$restaVoto = "UPDATE playlist SET cantidad_votos = cantidad_votos - 1 WHERE idPlaylist = $idPlaylist;";
				mysqli_query( $db->conexion, $deleteVota) or die("error al insertar voto.");
				mysqli_query( $db->conexion, $restaVoto) or die("error al sumar voto.");
			}
			if($valorVoto == 1){
				$insertVota = "INSERT INTO vota (codPlaylist, codUsuario) values ($idPlaylist, $idUsuario);";
				$sumaVoto = "UPDATE playlist SET cantidad_votos = cantidad_votos + 1 WHERE idPlaylist = $idPlaylist;";
				mysqli_query( $db->conexion, $insertVota) or die("error al insertar voto.");
				mysqli_query( $db->conexion, $sumaVoto) or die("error al sumar voto.");
			}
		}		
		$db->desconectar();
	}
		
	function eliminarPlaylist($idPlaylist){
		$playlistABorrar = new playlist($idPlaylist);
		$playlistABorrar -> eliminarPlaylist();
		header("location: home.php?idUsuario=". $_SESSION["idUsuario"] ."") ; 
	}
	
	function subirFoto($idPlaylist){
		$name = $_FILES['file']['name'];
		$extension = strtolower(substr($name, strpos($name, '.')+1));
		//$type = $_FILES['file']['type'];
		$size = $_FILES['file']['size'];
		$max_size = 50331648; //hasta 6MB = 50331648 bytes
		$tmp_name = $_FILES['file']['tmp_name'];

		if(isset($name)){
			if(!empty($name)){
				$location = "../fotos/" . basename($name);
				
				if($extension == 'jpg' || $extension == 'png'){
						if($size <= $max_size){
						if(move_uploaded_file($tmp_name, $location)){
						//playlist::insertarCancion($name, $_REQUEST['album'], $_REQUEST['artista'],$_REQUEST['generos'], $_SESSION['idUsuario']);
						$pn = new playlist($idPlaylist);
						$pn->insertarFoto($name);
						header("location: home.php?idUsuario=". $_SESSION["idUsuario"] ."") ; 
						}
					}
					else{
						$alerta = "Debe ser menor a 5 MB.";
						header("location: home.php?idUsuario=". $_SESSION["idUsuario"] ."&alerta=". $alerta ."") ; 
					}
					
				}
				else{
					$alerta = "Debe ser formato png o jpg.";
					header("location: home.php?idUsuario=". $_SESSION["idUsuario"] ."&alerta=". $alerta ."") ; 
				}

			}
			else{
				$alerta = "Por favor seleccione un archivo.";
				
				header("location: home.php?idUsuario=". $_SESSION["idUsuario"] ."&alerta=". $alerta .""); 
			}
		}
		
	}

?>