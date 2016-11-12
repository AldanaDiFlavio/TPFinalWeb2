<?php
$idCancion = $_GET["canciones"];
$conexion = mysqli_connect("127.0.0.1","root","","web2");

$sql = "SELECT idCancion id, path path FROM cancion WHERE baneo = 0 AND idCancion = " . $idCancion;
$resultado = mysqli_query($conexion, $sql);
while($fila = mysqli_fetch_assoc($resultado)){
	echo "<audio id='sonido' src='../$fila[path]' controls autoplay></audio>";
}




?>
