<?php
session_start();

$_SESSION['usuariosPorPais']='<img src="graficos/usuariosPorPais.png" alt="" border="0">';
$_SESSION['graficoUsuariosBaneados']='<img src="graficos/graficoUsuariosBaneados.png" alt="" border="0">';
$_SESSION['graficoRankingReproduccionesPlaylist']='<img src="graficos/graficoRankingReproduccionesPlaylist.png" alt="" border="0">';
$_SESSION['graficoRankingVotosPlaylist']='<img src="graficos/graficoRankingVotosPlaylist.png" alt="" border="0">';
$_SESSION['anio']="<img src='graficos/anio.png' alt='' border='0'>";

?>
<!DOCTYPE html>
<html>
	<body>
		<img src="anio.php?desde=<?php echo $_REQUEST['desde']; ?>&hasta=<?php echo $_REQUEST['hasta']; ?>" alt="" border="0">
		<br>
		<img src="usuariosPorPais.php" alt="" border="0">
		<br>
		<img src="graficoUsuariosBaneados.php" alt="" border="0">
		<br>
		<img src="graficoRankingReproduccionesPlaylist.php" alt="" border="0">
		<br>
		<img src="graficoRankingVotosPlaylist.php" alt="" border="0">
		<br>
		<a href='../exportarPDF.php'><input class="boton btn btn-success" type='button' value='exportar' ></input></a>
		<a href='../homeAdmin.php'><input class="boton btn btn-success" type='button' value='volver' ></input></a>
		
	</body>
</html>

