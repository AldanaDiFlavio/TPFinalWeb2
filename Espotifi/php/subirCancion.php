<?php
	/*include('../clases/cancion.php');


	$idCancion = $_POST['idCancion'];
	$titulo = $_POST['titulo'];
	$album = $_POST['album'];
	$artista = $_POST['artista'];
	$duracion = $_POST['duracion'];
	$codDueño = $_POST['codDueño'];
	$fecha = $_POST['fecha_creacion'];
	$baneo = $_POST['baneo'];
	$pathUrl = $_POST['pathUrl'];*/

	$name = $_FILES['file']['name'];
	$extension = strtolower(substr($name, strpos($name, '.')+1));
	$type = $_FILES['file']['type'];
	$size = $_FILES['file']['size'];
	$max_size = 50331648; //hasta 6MB = 50331648 bytes
	$tmp_name = $_FILES['file']['tmp_name'];

	if(isset($name)){
		if(!empty($name)){
			$location = "../canciones/" . basename($name);
			
			if(($extension == 'mp3' || $extension == 'MP3') && ($type == 'audio/mp3' || $type == 'audio/MP3')){

				if($size <= $max_size){
					if(move_uploaded_file($tmp_name, $location)){
					echo "Archivo subido";
					//$cancion = new Cancion($idCancion, $titulo, $album, $duracion, 'null', $fecha_creacion, 'false', $location);
					}
				}
				else{
					echo "Debe ser menor a 5MB.";
				}
				
			}
			else{
				echo "Debe ser formato .mp3 o .MP3";
			}


		}
		else{
			echo "Por favor elija un audio.";
		}
	}

?>


