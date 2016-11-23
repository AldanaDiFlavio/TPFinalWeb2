<?php
       include_once('../clases/db.php');

      	$db = new BaseDatos();
      	


      	$fechaIni=$_GET['fechaIni'];
		$fechaFin=$_GET['fechaFin'];
		$FInicial = date('Y-m-d', strtotime($fechaIni));
		$FFinal =  date('Y-m-d', strtotime($fechaFin));
		


      	if($db->conectar()){

      		if(empty($fechaIni) || empty($fechaFin)){
      			$sql = "SELECT nombre AS Playlist, fecha_creacion AS Fecha FROM playlist;";
      			$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
				$dataTable = array(array("Playlist", "Fecha"));

				while($fila = mysqli_fetch_assoc($result)){
				 	$dataTable[] = array($fila['Playlist'], $fila['Fecha']);
				}
				$db->desconectar();
				echo json_encode($dataTable);
      		}
      		else{
      			$sql = "SELECT nombre AS Playlist, fecha_creacion AS Fecha FROM playlist WHERE fecha_creacion BETWEEN '$FInicial' AND '$FFinal';";

				$result = mysqli_query( $db->conexion, $sql) or die("Error al listar usuarios.");
				$dataTable = array(array("Playlist", "Fecha"));


				while($fila = mysqli_fetch_assoc($result)){
				 	$dataTable[] = array($fila['Playlist'], $fila['Fecha']);		
				}
				$db->desconectar();
				echo json_encode($dataTable);

      		}
		}
		

?>
