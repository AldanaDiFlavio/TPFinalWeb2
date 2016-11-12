<?php 
	session_start(); 
	$idPlaylist = $_GET["idPlaylist"];
	include_once('../clases/db.php');
	include_once('../clases/playlist.php');
	echo "pl: " .$idPlaylist;
	echo " usuario: ". $_SESSION['idUsuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi Playlist</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript">
		
		function getXMLHTTP() {
			var xmlhttp=false;
			try{
				xmlhttp=new XMLHttpRequest();
			}
			catch(e)	{
				try{
					xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e){	
					try{
						xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch(e){
						xmlhttp=false;
					}
				}
			}
			return xmlhttp;
		}

		function reproduceCancion(canciones) {
			var strURL="../php/reproduceCancion.php?canciones="+canciones;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('audio').innerHTML =req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
		function editarElemento(elemento,elementok) { 
			if (elemento.style.display=='none' && elementok.style.display=='none') {
				elemento.style.display='block';
				elementok.style.display='block';
			} else {
				elemento.style.display='none';
				elementok.style.display='none';
			}
		} 
		
		
		function cambiarNombre(){
			var nuevo = document.getElementById('nombreNuevo').value;
			var strURL="cambiarNombre.php?nombreNuevo="+nuevo+"&idPlaylist="+<?php echo $idPlaylist;?>;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('nombre').innerHTML = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
			
		}
		
		function cambiarGenero(){
			var nuevo = document.getElementById('generoNuevo').value;
			var strURL="cambiarGenero.php?generoNuevo="+nuevo+"&idPlaylist="+<?php echo $idPlaylist;?>;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('genero').innerHTML = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
		function cambiarEstado(){
			var nuevo = document.getElementById('estadoNuevo').value;
			var strURL="cambiarEstado.php?estadoNuevo="+nuevo+"&idPlaylist="+<?php echo $idPlaylist;?>;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('estado').innerHTML = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
		function cambiarEsquema(){
			var nuevoFondo = document.getElementById('nuevoColorFondo').value;
			var nuevoLetras = document.getElementById('nuevoColorLetras').value;
			var idPlaylist = <?php echo $idPlaylist;?>;
			
			var patron="#";

			nuevoFondo = nuevoFondo.replace(patron,'');
			nuevoLetras = nuevoLetras.replace(patron,'');

			var strURL="cambiarEsquema.php?nuevoFondo="+nuevoFondo+"&nuevoLetras="+nuevoLetras+"&idPlaylist="+idPlaylist;
			
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementsByTagName('body')[0].style = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
		function eliminaCancion(idCancion){
			var strURL="eliminaCancion.php?idCancion="+idCancion+"&idPlaylist="+<?php echo $idPlaylist;?>;
			
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('tablaListadoCanciones').innerHTML = req.responseText ;
							listarTodasCanciones();
							validaCreacionPlaylist();
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
		function listarTodasCanciones(){

			var strURL="listarTodasCanciones.php?idPlaylist="+<?php echo $idPlaylist;?>;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('tablaListadoCancionesDisponibles').innerHTML = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}	
		}
		
		function agregarCancionNuevaAPlaylist(idCancionNueva){
			
			var strURL="agregarCancionNuevaAPlaylist.php?idCancionNueva="+idCancionNueva+"&idPlaylist="+<?php echo $idPlaylist;?>;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('tablaListadoCanciones').innerHTML = req.responseText ;
							listarTodasCanciones();
							validaCreacionPlaylist();
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
		function mostrarTodasLasCanciones(){
			if (tablaListadoCancionesDisponibles.style.display=='none'){
				tablaListadoCancionesDisponibles.style.display='block';
				
			} else {
				tablaListadoCancionesDisponibles.style.display='none';
				
			}
			listarTodasCanciones();
		}
		
		function validaCreacionPlaylist(){
			var cancionesCero = document.getElementById("tablaListadoCanciones").rows.length;
			if (cancionesCero > 1){
				document.getElementById('volver').disabled = false;
			} else document.getElementById('volver').disabled = true;
			
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
					
			<?php
				$db = new BaseDatos();
				if($db->conectar()){
					$buscarNombrePlaylist = "SELECT p.nombre, gp.descripcion, p.colorFondo, p.colorLetras, p.codDueno, e.descripcion estado FROM playlist p JOIN generoPlaylist gp ON gp.idGenero = p.codGenero JOIN estado e ON e.idEstado = p.codEstado WHERE p.idPlaylist = $idPlaylist;";
					$resultadoBuscarNombrePlaylist = mysqli_query( $db->conexion, $buscarNombrePlaylist) or die("error al buscar nombre de Playlist.");
				}
				while($row = mysqli_fetch_assoc($resultadoBuscarNombrePlaylist)){
					echo "<h2 id='nombre'>". $row["nombre"] ."</h2>";
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='#' onclick='editarElemento(nombreNuevo,nombreNuevoOk);' ><span class='glyphicon glyphicon-pencil'></a><input id='nombreNuevo' type='text' style='display:none;'></input><a id='nombreNuevoOk' href='#' onclick='cambiarNombre();' style='display:none;'><span class='glyphicon glyphicon-ok'></a>";
					}
					
					echo "<h4 id='estado'>". $row["estado"] ."</h4>";
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='#' onclick='editarElemento(estadoNuevo,estadoNuevoOk);'><span class='glyphicon glyphicon-pencil'></a><a id='estadoNuevoOk' href='#' onclick='cambiarEstado();' style='display:none;'><span class='glyphicon glyphicon-ok'></a>";
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
						$db1->desconectar();
					}
					
					
					echo "<h4 id='genero'>". $row["descripcion"] ."</h4>";
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a href='#' onclick='editarElemento(generoNuevo,generoNuevoOk);'><span class='glyphicon glyphicon-pencil'></a><a id='generoNuevoOk' href='#' onclick='cambiarGenero();' style='display:none;'><span class='glyphicon glyphicon-ok'></a>";
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
						$db1->desconectar();
					}
					if ($row["codDueno"] == $_SESSION['idUsuario']){
					echo "<br> 
					Color fondo <input id='nuevoColorFondo' name='nuevoColorFondo' type='color' onchange='cambiarEsquema()' value='#". $row["colorFondo"] ."'/>
					Color letras <input id='nuevoColorLetras' name='nuevoColorLetras' type='color' onchange='cambiarEsquema()' value='#". $row["colorLetras"] ."'/><br>";
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
									<td><a onclick='eliminaCancion(" . $row1["idCancion"] . ");'><span class='glyphicon glyphicon-remove'></a>
									";
								}
							echo "
							</tr>";
						}
					}	
					echo "</table>";
					$db1->desconectar();
					if ($row["codDueno"] == $_SESSION['idUsuario']){
						echo "<a onclick='mostrarTodasLasCanciones();'><span class='glyphicon glyphicon-plus'></a>
						<table name='tablaListadoCancionesDisponibles' id='tablaListadoCancionesDisponibles' style='display:none;'></table>";
					}
				}
				$db->desconectar();
				

			?>
			
			
			<div id='audio'></div>
			<br><br>
			<a href="home.php"><input id="volver" type='button' value='home' onclick=''></input></a>
	<div id="prueba"></div>
	</div>

	<footer>
	</footer>

 	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>