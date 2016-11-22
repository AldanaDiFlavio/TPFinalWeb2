<?php
       include_once('../clases/db.php');
      	$db = new BaseDatos();
      	
      	if($db->conectar()){
			$sql = "SELECT count(*) as Cantidad, ubicacion FROM usuario GROUP BY ubicacion;";
			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
			$dataTable = array(array("País", "Cantidad"));

			while($fila = mysqli_fetch_assoc($result)){

				if(($fila['ubicacion'] == "") || (is_null($fila['ubicacion']))){
					$dataTable[] = array('Otros', (int)$fila['Cantidad']);
				} 
				else{ 
					$dataTable[] = array($fila['ubicacion'], (int)$fila['Cantidad']);
				}
		}
			$db->desconectar();
			echo json_encode($dataTable);
		}
		

		
?>