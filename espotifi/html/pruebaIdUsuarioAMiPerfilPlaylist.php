<?php
session_start();
	$_SESSION['idUsuario'] = 2;
include_once('../clases/db.php');
$db = new BaseDatos();
				$idUsuario = $_SESSION['idUsuario'];
				if($db->conectar()){
					$buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, gp.descripcion FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero WHERE p.baneo = 0;";
					$resultadoBuscaTodasPlaylistDisponibles = mysqli_query( $db->conexion, $buscaTodasPlaylistDisponibles) or die("error al buscar todas mis Playlist.");
				}
				while($row = mysqli_fetch_assoc($resultadoBuscaTodasPlaylistDisponibles)){
					echo "<b><a href='miPlaylist.php?idPlaylist=". $row["idPlaylist"] ."'>". $row["nombre"] ."</a></b> Genero: ". $row["descripcion"] ."<br>";
					
				}
				
				echo "<div id='audio'></div>";
				$db->desconectar();


?>