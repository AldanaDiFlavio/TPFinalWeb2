<?php
       include_once('../clases/db.php');

      	$db = new BaseDatos();
      	
      	$fechaIni=$_POST['fechaIni'];
		$fechaFin=$_POST['fechaFin'];
      	
      	if($db->conectar()){
			$sql = "SELECT nombre AS Playlist, fecha_creacion AS Fecha FROM playlist WHERE fecha_creacion BETWEEN '$fechaIni' AND '$fechaFin' ORDER BY fecha_creacion DESC;";
			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
			$dataTable = array(array("Playlist", "Cantidad"));


			while($fila = mysqli_fetch_assoc($result)){
				 $dataTable[] = array($fila['Playlist'], (int)$fila['Cantidad']);

				}
			$db->desconectar();
			echo json_encode($dataTable);
			location '../html/estadisticas.php';
		}
		

		
?>
