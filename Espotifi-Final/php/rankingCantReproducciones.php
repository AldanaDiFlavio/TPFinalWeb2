<?php
       include_once('../clases/db.php');
      	$db = new BaseDatos();
      	
      	if($db->conectar()){
			$sql = "SELECT nombre AS Playlist, cantidad_reproducciones AS Cantidad FROM playlist ORDER BY cantidad_reproducciones DESC LIMIT 10;";
			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
			$dataTable = array(array("Playlist", "Cantidad"));

			while($fila = mysqli_fetch_assoc($result)){

				 
					$dataTable[] = array($fila['Playlist'], (int)$fila['Cantidad']);
				}
			$db->desconectar();
			echo json_encode($dataTable);
		}
		

		
?>