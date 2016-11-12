<?php
	session_start();

		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		
		$idUsuario = $_SESSION['idUsuario'];
		$filtroPrimario = $_REQUEST['filtroPrimario'];
		$filtroSecundario = $_REQUEST['filtroSecundario'];
		$textoBuscado = $_REQUEST['textoBuscado'];
			
		echo $filtroPrimario;
		echo $filtroSecundario;
		echo $textoBuscado;
			
		$db = new BaseDatos();
		
		if($db->conectar()){
			if ($filtroPrimario == 'filtroUsuario'){
				$busqueda = "SELECT idUsuario, nombre FROM usuario WHERE nombre = '$textoBuscado'";
				$resultadoBusqueda = mysqli_query( $db->conexion, $busqueda) or die("error al buscar usuario.");
				
				while($row = mysqli_fetch_assoc($resultadoBusqueda)){
					echo "
					<tr>
						<th>". $row["nombre"] ."</th>  
						<th></th>
					</tr>";
				}
			} 
			if ($filtroPrimario == 'filtroPlaylist' AND $filtroSecundario == 'nombre'){
				$busqueda = "SELECT p.idPlaylist, p.titulo, p.album, p.artista, gp.descripcion genero, e.descripcion estado
						FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero JOIN estado e ON e.idEstado = p.codEstado
						WHERE p.titulo = '$textoBuscado' AND baneo = 0";	
						
				$resultadoBusqueda = mysqli_query( $db->conexion, $busqueda) or die("error al buscar playlist por nombre.");
				
				while($row = mysqli_fetch_assoc($resultadoBusqueda)){
					echo "
					<tr>
						<th>". $row["titulo"] ."</th>  
						<th>". $row["album"] ."</th>
						<th>". $row["artista"] ."</th>
						<th>". $row["genero"] ."</th>
						<th>". $row["estado"] ."</th>
					</tr>";
				}
			}
			if ($filtroPrimario == 'filtroPlaylist' AND $filtroSecundario == 'genero'){
				$busqueda = "SELECT p.idPlaylist, p.titulo, p.album, p.artista, gp.descripcion, e.descripcion 
						FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero JOIN estado e ON e.idEstado = p.codEstado
						WHERE gp.descripcion = '$textoBuscado' AND baneo = 0";	
					
				$resultadoBusqueda = mysqli_query( $db->conexion, $busqueda) or die("error al buscar playlist por genero.");
				
				while($row = mysqli_fetch_assoc($resultadoBusqueda)){
					echo "
					<tr>
						<th>". $row["titulo"] ."</th>  
						<th>". $row["album"] ."</th>
						<th>". $row["artista"] ."</th>
						<th>". $row["genero"] ."</th>
						<th>". $row["estado"] ."</th>
					</tr>";
				}	
			
			}
			
		}	
	
		$db->desconectar();
?>