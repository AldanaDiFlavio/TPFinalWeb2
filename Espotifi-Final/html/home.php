<?php
	session_start();
	if ($_SESSION['login'] == "on")
		{
			include_once('../clases/playlist.php');
			include_once('../clases/usuario.php');
			include_once('../clases/cancion.php');
			include_once('../clases/administrador.php');
			
			playlist::purgaPlaylistVacias($_SESSION['idUsuario']);
			
			$idUsuarioRecibido = $_REQUEST['idUsuario'];
			
			$usuarioSession = new usuario($_SESSION['idUsuario']);
			$nombreSession = $usuarioSession->armarUsuario();
			
			if ($_SESSION['idUsuario'] == $idUsuarioRecibido){
				$IdPerfilActual = $_SESSION['idUsuario'];
				
				
			} else {
				$IdPerfilActual = $idUsuarioRecibido;
				$usuarioPerfil = new usuario($IdPerfilActual);
				$nombrePerfil = $usuarioPerfil->armarUsuario();
				
			}
		}else{
			 header('location: ../html/index.php'); 
			 }  
	//para ver el perfil
	$_SESSION['nombreSession'] = $nombreSession;
	$_SESSION['perfil'] = "Ver Perfil";	
	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Espotifí</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript" src="javaScript/funcionesHome.js"></script>
	<script type="text/javascript" src="javaScript/funcionesAdministrador.js"></script>
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
														window.alert('No results found');
														}
								} 
								else{
									window.alert('Geocoder failed due to: ' + status);
									}
							});
						}
	</script>
	
	</head>
<body>
	
	<div class="container">
		
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" style="<?php if ($_SESSION['admin'] == 'true'){ echo "display: none;"; } ?>">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a href="home.php" class="navbar-brand"><img src="../imagenes/espotifi-logo2.png" alt="Espotifi" width="120px"></a>
				</div>

				<div class="collapse navbar-collapse" id="navbar">
					<ul class="nav navbar-nav">
						<li><a href="funcionesHome.php?funcion=crearPlaylistNueva" title="Crear Playlist nueva"><span class="glyphicon glyphicon-plus"></span></a></li>
						<li><a href="" title="Mis Playlist"><span class="glyphicon glyphicon-list"></span></a></li>
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
						<li><a class="usuario" title="Perfil" onclick = "verPerfil()"><?php  echo $nombreSession; ?></a></li>
						<li><a href="index.php" class="salir" title="salir">salir</a></li>
						<li><a href="#"></a></li>
					</ul>
				
				</div>	
				
			</div>
				
		</nav>
		
		<div id="perfil" style="float: right; margin-top: 50px; ">	</div>	
		
		<div id="todasMisPlaylist" style="margin-top: 200px;">
			<b><?php if (isset($nombrePerfil)){ 
						echo "Playlist de ". $nombrePerfil. "";
					} else echo "Mis Playlist"; 
				?>  </b>
			<?php
				if (isset($nombrePerfil)){
					$db = new BaseDatos();
					if($db->conectar()){
						$buscarSeguidor = "SELECT estado FROM sigue WHERE idUsuarioJefe = ". $IdPerfilActual ." AND idUsuarioSeguidor = " . $_SESSION['idUsuario'] ."";
						$resultadoBuscarSeguidor = mysqli_query( $db->conexion, $buscarSeguidor) or die("error al buscar seguidor.");
							
						$totalFilasSeguidor =  mysqli_num_rows($resultadoBuscarSeguidor);
						
						if (isset($_SESSION['admin']) != 'true'){  						
							if($totalFilasSeguidor != 0){
								$classSeguidor = "glyphicon glyphicon-star";
							} else $classSeguidor = "glyphicon glyphicon-star-empty";
							echo "<a href='#' onclick='seguir(". $IdPerfilActual . ",". $_SESSION['idUsuario'] .");'><span id='seguir' class='". $classSeguidor ."' /></a>";
						}
					}
	
					$db->desconectar();
				}
				echo "<br>";
				echo"<div id='todasMisPlaylist'>"; playlist::todasMisPlaylist($IdPerfilActual, $_SESSION['idUsuario']);echo "</dvi>";
			?>
		</div>
		<div id="misCanciones">
		<?php
			
			if (!isset($nombrePerfil)){ 
				echo "<b>Mis canciones</b><br>";
				cancion::todasMisCanciones($_SESSION['idUsuario']);
				
				echo "<a href='subirCancionNueva.php' target='_blank'>Subir canción nueva</a>";
			
			}
		?>
		</div>
		
		<div id="mis seguidores" style="magin-left: 300px;">
			
			<?php
				
				if (!isset($nombrePerfil)){
					echo "<b><span>Siguiendo a</span></b>";
					usuario::listarMisSeguidores($_SESSION['idUsuario']);
				}
			?>
			
		</div>
		<?php
			if (isset($_SESSION['admin']) != 'true'){  
				if (isset($nombrePerfil)){
					echo "<a href='#' onclick='editarElemento(selectDenuncias, okDenuncias);'>denunciar</a>
							<select id='selectDenuncias' style='display:none;'>
								<option value='0'>Nombres inapropiados</option>
								<option value='1'>copia playlist</option>
							</select>
							<a onclick='editarElemento(selectDenuncias, okDenuncias);'><span onclick='enviarDenuncia(selectDenuncias, ". $IdPerfilActual .")' id='okDenuncias' class='glyphicon glyphicon-send' aria-hidden='true' style='display:none;'></span></a><br>";
					
					echo "<a href='home.php?idUsuario=". $_SESSION['idUsuario'] ."'>volver a mi perfil</a>";
				}
			}	
		?>
		<div id="busquedas" style="margin-top: 50px;">
		</div>
	</div>
		<!--ubicacion de origen con google maps-->
		<div onload="geocodeLatLng()">
				<?php
					
					$conexion = mysqli_connect("localhost", "root", "mysql153", "web2")
								or die('No se pudo conectar:'  . mysqli_error($conexion));
					$query = mysqli_query($conexion, "SELECT * FROM usuario WHERE nombre LIKE '$nombreSession';") or die ("Fallo la consulta");
					$ver = mysqli_fetch_assoc($query);
					//echo "<br>Coordenadas" . $ver["coordenadas"];
					//str_replace ( $valor_a_buscar , $valor_de_reemplazo , $string , [$contador ] )
					$cords = str_replace ("(" , "" , $ver["coordenadas"]);
				?>
				<input id="latlng" type="hidden" value="<?php echo $cords; ?>">
				<div id="map" style = "width: 500px; height: 400px;"></div>
		</div>
    
		
	<footer>
	</footer>

 	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>