<?php
       include_once('../clases/db.php');
      	$db = new BaseDatos();
      	
      	if($db->conectar()){
			$sql = "SELECT nombre AS Playlist, cantidad_votos AS Votos FROM playlist ORDER BY cantidad_votos DESC;";
			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
			$dataTable = array(array("Playlist", "Votos"));

			while($fila = mysqli_fetch_assoc($result)){

				 
					$dataTable[] = array($fila['Playlist'], (int)$fila['Votos']);
				}
			$db->desconectar();
			echo json_encode($dataTable);
		}
		

		
?>