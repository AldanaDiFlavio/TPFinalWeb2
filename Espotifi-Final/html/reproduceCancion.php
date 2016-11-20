<?php
	session_start();
	include_once('../clases/db.php');
	
	$funcion = $_REQUEST['funcion'];
	
	if ($funcion == 'reproduceCancion'){
		reproduceCancion($_REQUEST['canciones']);
	}
	
	function reproduceCancion($idCancion){		
		$db = new BaseDatos();
		if($db->conectar()){
			$buscaCancion = "SELECT idCancion id, path path FROM cancion WHERE baneo = 0 AND idCancion = " . $idCancion;
			$resultadoBuscaCancion = mysqli_query($db->conexion, $buscaCancion);
		}
		
		while($row = mysqli_fetch_assoc($resultadoBuscaCancion)){
			echo "<audio id='sonido' src='../$row[path]' controls autoplay></audio>";
		}		
		$db->desconectar();
	}
?>