<?php
       include_once('../clases/db.php');
      	$db = new BaseDatos();
      	
      	if($db->conectar()){
			$sql = "SELECT count(*) as Cantidad, habilitado FROM usuario GROUP BY habilitado;";
			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
			$dataTable = array(array("Tipo", "Cantidad"));

			while($fila = mysqli_fetch_assoc($result)){

				if($fila['habilitado'] == "true"){
					$dataTable[] = array('Habilitado', (int)$fila['Cantidad']);
				} 
				else{ 
					$dataTable[] = array('Desabilitado', (int)$fila['Cantidad']);
					
				}
		}
			$db->desconectar();
			echo json_encode($dataTable);
		}
		

		
?>