<?php 
	session_start(); 
	
	if ($_SESSION['login'] == "on")
		{
		
		$idPlaylist = $_REQUEST["idPlaylist"];
		include_once('../clases/db.php');
		include_once('../clases/playlist.php');
		include_once('../clases/database.php');
		include_once('../clases/usuario.php');
		$usuarioSession = new usuario($_SESSION['idUsuario']);
			$nombreSession = $usuarioSession->armarUsuario();
		
		$sumaReproduccion = new Playlist($idPlaylist);
		$sumaReproduccion -> sumaReproduccion($_SESSION['idUsuario']);
		}else{
			 header('location: ../html/index.php'); 
			 }  
			 
	
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi Playlist</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript" src="javaScript/funcionesMiPlaylist.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJD_N_jOh_hh32hRQVqPr0Ch14ghe42g0&callback=initMap"
	type="text/javascript"></script>
	<script>			
	function verPerfil(){
						xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function()	
							{
							if (this.readyState == 4 && this.status == 200)
								{
								document.getElementById("perfil").innerHTML = this.responseText;
								}
							};
						xhttp.open("GET", "../php/verperfil.php", "true");
						xhttp.send();
						}

	function initMap()	{
						var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 8,
						center: {lat: 40.731, lng: -73.997}
						});
						var geocoder = new google.maps.Geocoder;
						var infowindow = new google.maps.InfoWindow;

						geocodeLatLng(geocoder, map, infowindow);
						}

	function geocodeLatLng(geocoder, map, infowindow)
						{
						var input = document.getElementById('latlng').value;
						var latlngStr = input.split(',', 2);
						var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
						geocoder.geocode({'location': latlng}, function(results, status)
							{
							if (status === google.maps.GeocoderStatus.OK) 
								{
								if (results[1]) {
												map.setZoom(11);
       
												var marker = new google.maps.Marker({
												position: latlng,
												map: map
												});
												map.setCenter(latlng);
												infowindow.setContent(results[1].formatted_address);
												infowindow.open(map, marker);
												} 
												else	{
														window.alert('Sin resultados :(');
														}
								} 
								else{
									window.alert('Este usuario no posee coordenadas:  ' + status);
									}
							});
						}
	</script>
</head>
<body onload="validaCreacionPlaylist();" style="background-color: <?php
								$db = new BaseDatos();
								if($db->conectar()){
									$buscarNombrePlaylist = "SELECT colorFondo, colorLetras FROM playlist WHERE idPlaylist = $idPlaylist;";
									$resultadoBuscarNombrePlaylist = mysqli_query( $db->conexion, $buscarNombrePlaylist) or die("error al buscar nombre de Playlist.");
								}
								while($row = mysqli_fetch_assoc($resultadoBuscarNombrePlaylist)){
									echo "#". $row["colorFondo"] ."; color: #". $row["colorLetras"] .";";
								}
								
								$db->desconectar();
								?>">
	<div id="container" class="container" class="acciones" >
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" style="<?php if ($_SESSION['admin'] == 'true'){ echo "display: none;"; } ?>">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a href="#" class="navbar-brand"><img src="../imagenes/espotifi-logo2.png" alt="Espotifi" width="120px"></a>
				</div>

				<div class="collapse navbar-collapse" id="navbar">
					<ul class="nav navbar-nav">
						<li><a href="funcionesHome.php?funcion=crearPlaylistNueva" title="Crear Playlist nueva"><span class="glyphicon glyphicon-plus"></span></a></li>
					</ul>
					
					<form action="" class="navbar-form navbar-left" role="search">
					
						<div id="buscador" style="color: white;" class="form-group">
							<input name="busqueda" type="text" class=" buscador form-control " placeholder="Buscá Playlist o Usuarios" onkeyup="realizarBusqueda(this.value, <?php echo $_SESSION['idUsuario']; ?>);">
							<input type="radio" name="filtroPrimario" checked value="filtroUsuario" onchange="habilitaFiltros()">usuario
							<input type="radio" name="filtroPrimario" value="filtroPlaylist" onchange="habilitaFiltros()">playlist
							<select id="filtrosPlaylist" name="filtrosPlaylist" style="color:black; display:none;" onchange="realizarBusqueda(busqueda.value, <?php echo $_SESSION['idUsuario']; ?>);">
							  <option value="nombre" selected>nombre</option>
							  <option value="genero">genero</option>
							</select>
						</div>
						
					</form>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><img src="../imagenes/sin-título-5.jpg" alt="Perfil" width="30px" class="img-circle" title="Perfil"></a></li>
						<li><a href="#" class="usuario" title="Perfil"><?php  echo $nombreSession; ?></a></li>
						<li><a href="index.php" class="salir" title="salir">salir</a></li>
						
						<li><a href="#"></a></li>
						
					</ul>
				
				</div>	
				
			</div>
				
		</nav>

	</div>

		<div class="container cancion">
			<div class="row">		
			<?php
				echo "<div class='col-md-4'>";
				$db = new BaseDatos();
				if($db->conectar()){
					$buscarNombrePlaylist = "SELECT p.nombre, cantidad_reproducciones cr, u.nombre usuario, gp.descripcion, p.colorFondo, p.colorLetras, p.codDueno, e.descripcion estado, p.fotoPath  FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero JOIN estado e ON e.idEstado = p.codEstado JOIN usuario u ON p.codDueno = u.idUsuario WHERE p.idPlaylist = $idPlaylist;";
					$resultadoBuscarNombrePlaylist = mysqli_query( $db->conexion, $buscarNombrePlaylist) or die("error al buscar nombre de Playlist.");
				}
				while($row = mysqli_fetch_assoc($resultadoBuscarNombrePlaylist)){
					echo "<b><span id='nombre'>". $row["nombre"];
					
					if ($row["codDueno"] != $_SESSION['idUsuario']){
						$idUsuario = $_SESSION['idUsuario'];
							if (isset($_SESSION['admin']) != 'true'){ 
							$buscarVoto = "SELECT codPlaylist FROM vota WHERE codPlaylist = ". $idPlaylist ." AND codUsuario = " . $idUsuario ."";
							$resultadoBuscarVoto = mysqli_query( $db->conexion, $buscarVoto) or die("error al buscar los votos.");
							
							
							$totalFilas =  mysqli_num_rows($resultadoBuscarVoto);
							
							if($totalFilas != 0){
							$classVoto = "glyphicon glyphicon-collapse-up";
							} else $classVoto = "glyphicon glyphicon-unchecked";
							
							echo "<a href='#' onclick='sumarVoto(". $idPlaylist . ",". $_SESSION['idUsuario'] .");'><span id='voto' class='". $classVoto ."' /></a>";
						}
					}
					
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='#' onclick='editarElemento(nombreNuevo,nombreNuevoOk);' ><span class='glyphicon glyphicon-pencil' /></a><input id='nombreNuevo' type='text' style='display:none;'></input><a  id='nombreNuevoOk'  href='#' onclick='cambiarNombre(". $idPlaylist .");' style='display:none;'><span onclick='editarElemento(nombreNuevo,nombreNuevoOk);' class='glyphicon glyphicon-ok' /></a>";
					}
					echo " ". $row["cr"] ." reproducciones! <span></span>";
					echo "<br><span>". $row["usuario"] ."</span><br>";

					echo "<span id='estado'>". $row["estado"] ."</span>";
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='#' onclick='editarElemento(estadoNuevo,estadoNuevoOk);'><span class='glyphicon glyphicon-pencil'></a>";
						$db1 = new BaseDatos();
						if($db1->conectar()){
							$buscarEstadosPlaylist = "SELECT idEstado, descripcion FROM estado;";
							$resultadoBuscarEstadosPlaylist = mysqli_query( $db1->conexion, $buscarEstadosPlaylist) or die("error al buscar los estados de Playlist.");
						}
						
						echo "<select id='estadoNuevo' name='estadoNuevo' style='display:none;'>";
						while($row2 = mysqli_fetch_assoc($resultadoBuscarEstadosPlaylist)){
							echo "<option value='". $row2["idEstado"] ."'>". $row2["descripcion"] ."</option>";
						}
						echo "</select>";
						echo "<a id='estadoNuevoOk' href='#' onclick='cambiarEstado(". $idPlaylist .");' style='display:none;'><span onclick='editarElemento(estadoNuevo,estadoNuevoOk);' class='glyphicon glyphicon-ok'></a>";
						$db1->desconectar();
					}
					
					
					echo "<br><span id='genero'>". $row["descripcion"] ."</span>";
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='#' onclick='editarElemento(generoNuevo,generoNuevoOk);'><span class='glyphicon glyphicon-pencil'></a>";
						$db1 = new BaseDatos();
						if($db1->conectar()){
							
							$buscarGenerosPlaylist = "SELECT idGenero, descripcion FROM generoPlaylist;";
							$generosPlaylist = mysqli_query( $db1->conexion, $buscarGenerosPlaylist) or die("error al buscar los generos de Playlist.");
						}
						echo "<select id='generoNuevo' name='generoNuevo' style='display:none;'>";
						while($row2 = mysqli_fetch_assoc($generosPlaylist)){
							echo "<option value='". $row2["idGenero"] ."'>". $row2["descripcion"] ."</option>";
						}
						echo "</select>";
						echo "<a id='generoNuevoOk' href='#' onclick='cambiarGenero(". $idPlaylist .");' style='display:none;'><span onclick='editarElemento(generoNuevo,generoNuevoOk);' class='glyphicon glyphicon-ok'></a>";

						$db1->desconectar();
					}
					if ($row["codDueno"] == $_SESSION['idUsuario']){
					echo "<br> 
					Color fondo <input id='nuevoColorFondo' name='nuevoColorFondo' type='color' onchange='cambiarEsquema(". $idPlaylist .")' value='#". $row["colorFondo"] ."'/>
					Color letras <input id='nuevoColorLetras' name='nuevoColorLetras' type='color' onchange='cambiarEsquema(". $idPlaylist .")' value='#". $row["colorLetras"] ."'/><br>";
					}
					echo "
					<table id='tablaListadoCanciones'>";
					
					$db1 = new BaseDatos();
					if($db1->conectar()){
						$buscarTodasCanciones = "SELECT c.idCancion, c.titulo, c.artista, c.album, gc.descripcion FROM cancion c JOIN generoCanciones gc ON c.codGenero = gc.idGenero JOIN contiene con ON con.codCancion = c.idCancion WHERE con.codPlaylist = $idPlaylist";
						$resultadobuscarTodasCanciones = mysqli_query( $db1->conexion, $buscarTodasCanciones) or die("error al listar las canciones.");
						echo "
						<tr>
								<th>Titulo </th>
								<th>Artista </th>
								<th>Album </th>
								<th>Genero </th>
						</tr>";
						while($row1 = mysqli_fetch_assoc($resultadobuscarTodasCanciones)){
							echo "
							<tr>
								<td>". $row1["titulo"] . "</td> 
								<td>". $row1["artista"] . "</td> 
								<td>". $row1["album"] . "</td> 
								<td>". $row1["descripcion"] . "</td> 
								<td><a onclick='reproduceCancion(" . $row1["idCancion"] . ");'><span class='glyphicon glyphicon-play-circle'></span></a></td>
								";

								if ($row["codDueno"] == $_SESSION['idUsuario']){
									echo "
									<td><a onclick='eliminaCancion(" . $row1["idCancion"] . ",". $idPlaylist .");'><span class='glyphicon glyphicon-remove'></a>
									";
								}
							echo "
							</tr>";
						}
					}	
					echo "</table>";
					$db1->desconectar();


					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a onclick='mostrarTodasLasCanciones(". $idPlaylist .");'><span class='glyphicon glyphicon-plus'></a>
						<table name='tablaListadoCancionesDisponibles' id='tablaListadoCancionesDisponibles' style='display:none;'></table>";
					}


					echo "<div id='audio'></div><br>";

					 echo "</span>
					<a href='qrURL.php?idPlaylist=<?php echo $idPlaylist; ?>' method='POST' target='_blank'><span class='glyphicon glyphicon-qrcode'></span>  Mostrar QR</a></b><br><br> " ;
			
					echo "<a href='home.php?idUsuario=". $row["codDueno"] ."'><input class='boton btn btn-success' id='volver' type='button' value='confirmar' ></input></a>";
					
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='funcionesMiPlaylist.php?funcion=eliminarPlaylist&idPlaylist=". $idPlaylist ."'><input class='boton btn btn-success' type='button' value='eliminar'></input></a>";
			echo "</div>";
			echo "<div class='col-md-5'>";
			echo "<b>Portada de tu playlist</b>";
					echo "
					<form style='color: black;' action='funcionesMiPlaylist.php?funcion=subirFoto&idPlaylist=". $idPlaylist ."' method='post' enctype='multipart/form-data'>
						<input name='file' type='file'>
						<input class='boton btn btn-success' id='submit'type='submit' value='Subir/cambiar foto'>
					</form>
					";}

					if ($row['fotoPath'] != "0" ){
					echo "<img src='../". $row["fotoPath"] ."'width='400' >";
					}

					
				}
			echo "</div>";
			$db->desconectar();
			?>	
			
		<!--ubicacion de origen con google maps-->
		<div class="col-md-3">
		<b>Ubicación</b>
		<div onload="geocodeLatLng()">
				<?php
					$db = new BaseDatos();
					
					if($db->conectar()){
					
						/*
						$conexion = mysqli_connect("localhost", "root", "", "web2")
									or die('No se pudo conectar:'  . mysqli_error($conexion));
						*/
						$query = mysqli_query($db->conexion, "SELECT * FROM usuario WHERE idUsuario IN (SELECT codDueno FROM playlist WHERE idplaylist = $idPlaylist);") or die ("Fallo la consulta");
						$ver = mysqli_fetch_assoc($query);
						//echo "<br>Coordenadas" . $ver["coordenadas"];
						//str_replace ( $valor_a_buscar , $valor_de_reemplazo , $string , [$contador ] )
						$cords = str_replace ("(" , "" , $ver["coordenadas"]);
					}
					$db->desconectar();
				?>
				<br/>
				<input id="latlng" type="hidden" value="<?php echo $cords; ?>">
				<div class="center-block" id="map" style = "width: 300px; height: 200px;"></div>
		</div>	
		</div>
		</div>
		</div>

				

</div>
	<footer>
		<div class="container">		
			<img class="center-block" src="../imagenes/espotifi-iso.png" alt="Espotifi" width="25px">
			<div class="row">
				<div class="col-md-4 col-md-offset-5">
					<p>Espotifi - Programación Web 2 </p>				
				</div>
			</div>
	</footer>

 	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>