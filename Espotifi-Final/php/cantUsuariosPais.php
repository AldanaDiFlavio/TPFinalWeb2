<?php
       include_once('../clases/db.php');
      	$db = new BaseDatos();
      	
      	if($db->conectar()){
			$sql = "SELECT count(*) as Cantidad, pais FROM usuario GROUP BY pais;";
			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
			$dataTable = array(array("País", "Cantidad"));

			while($fila = mysqli_fetch_assoc($result)){

				if(($fila['pais'] == "") || (is_null($fila['pais']))){
					$dataTable[] = array('Otros', (int)$fila['Cantidad']);
				} 
				else{ 
					$dataTable[] = array($fila['pais'], (int)$fila['Cantidad']);
				}
		}
			$db->desconectar();
			echo json_encode($dataTable);
		}
		

		
?>