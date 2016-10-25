<?php
	include('../clases/playlist.php');
	
	$accion = $_POST['accion'];
	
	if ($accion == "crear"){
		$nombre = $_POST['nombre'];
		
		playlist::crearPlaylist($nombre);  		
	}	
	
	if ($accion == "agregar"){
		$idPlaylist = $_POST['playlist'];
		
		$db = new BaseDatos();
				if($db->conectar()){															
							foreach($_POST['check_list'] as $check) {
								$idCancion = "$check";								
								$playlist = new playlist($idPlaylist);
								$playlist->agregarCancion($idCancion);
							}    			 
				}
				$db->desconectar();
	}
	
	if ($accion == "cambiar estado"){
		$idPlaylist = $_POST['playlist'];
		$idEstado = $_POST['estado'];
		
		$db = new BaseDatos();
				if($db->conectar()){						
							$playlist = new playlist($idPlaylist);
							$playlist->asignarEstado($idEstado);   				 
				}
				$db->desconectar();
	}
	
	if ($accion == "cambiar esquema"){
		$idPlaylist = $_POST['playlist'];
		$idEsquema = $_POST['esquema'];
		
		$db = new BaseDatos();
				if($db->conectar()){						
							$playlist = new playlist($idPlaylist);
							$playlist->asignarEsquema($idEsquema);   
				}
				$db->desconectar();
	}
	
	if ($accion == "cambiar genero de playlist"){
		$idPlaylist = $_POST['playlist'];
		$idGenero = $_POST['generos'];
		
		$db = new BaseDatos();
				if($db->conectar()){							
							$playlist = new playlist($idPlaylist);
							$playlist->asignarGenero($idGenero);   		  
				}
				$db->desconectar();
	}
?>

