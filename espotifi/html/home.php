<?php
	session_start();
	$_SESSION['idUsuario'] = 1;
	include_once('../clases/db.php');
	include_once('../clases/playlist.php');
	playlist::purgaPlaylistVacias($_SESSION['idUsuario']);
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

		function habilitaFiltros(){	
			if (document.getElementById('filtrosPlaylist').style.display == 'none'){ 
				document.getElementById('filtrosPlaylist').style.display = 'block' 
			} else { document.getElementById('filtrosPlaylist').style.display = 'none' }
			realizarBusqueda();
		}
		
		function realizarBusqueda(textoBuscado){
			var filtroUsuario = document.getElementsByName('filtroPrimario')[0];
			var filtroPlaylist = document.getElementsByName('filtroPrimario')[1];
			var filtroSecundarioPlaylist = document.getElementById('filtrosPlaylist').value;
			
			if (filtroUsuario.checked == true) {
				//document.getElementById('todasMisPlaylist').innerHTML = "usuario";
				var strURL="realizarBusqueda.php?filtroPrimario="+filtroUsuario.value+"&filtroSecundario='nada'&textoBuscado="+textoBuscado;
			}
			if (filtroPlaylist.checked == true && filtroSecundarioPlaylist == 'nombre') {
				//document.getElementById('todasMisPlaylist').innerHTML = "playlist - nombre";
				var strURL="realizarBusqueda.php?filtroPrimario="+filtroPlaylist.value+"&filtroSecundario="+filtroSecundarioPlaylist+"&textoBuscado="+textoBuscado;
			}
			if (filtroPlaylist.checked == true && filtroSecundarioPlaylist == 'genero') {
				//document.getElementById('todasMisPlaylist').innerHTML = "playlist - genero";
				var strURL="realizarBusqueda.php?filtroPrimario="+filtroPlaylist.value+"&filtroSecundario="+filtroSecundarioPlaylist+"&textoBuscado="+textoBuscado;
			}
			var req = getXMLHTTP();
			
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('todasMisPlaylist').innerHTML = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
			
			
		}
	</script>
	
	
	</head>
<body>
	
	<div class="container">
		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
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
						<li><a href="crearPlaylistNueva.php" title="Crear Playlist nueva"><span class="glyphicon glyphicon-plus"></span></a></li>
						<li><a href="" title="Mis Playlist"><span class="glyphicon glyphicon-list"></span></a></li>
					</ul>
					
					<form action="" class="navbar-form navbar-left" role="search">
						<div id="buscador" style="color: white;" class="form-group">
							<input type="text" class=" buscador form-control " placeholder="Buscá Playlist o Usuarios" onkeyup="realizarBusqueda(this.value);">
							<input type="radio" name="filtroPrimario" checked value="filtroUsuario" onchange="habilitaFiltros()">usuario
							<input type="radio" name="filtroPrimario" value="filtroPlaylist" onchange="habilitaFiltros()">playlist
							<select id="filtrosPlaylist" name="filtrosPlaylist" style="color:black; display:none;" onchange="realizarBusqueda();">
							  <option value="nombre" selected>nombre</option>
							  <option value="genero">genero</option>
							</select>
						</div>
					</form>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><img src="../imagenes/sin-título-5.jpg" alt="Perfil" width="30px" class="img-circle" title="Perfil"></a></li>
						<li><a href="#" class="usuario" title="Perfil">Nombre Usuario</a></li>
						<li><a href="#"></a></li>
						
					</ul>
				
				</div>	
				
			</div>
				
		</nav>
		<div id="todasMisPlaylist" style="margin-top: 200px;">
			<h2>mis playlist:</h2><br>
			<?php
				$db = new BaseDatos();
				$idUsuario = $_SESSION['idUsuario'];
				if($db->conectar()){
					$buscaTodasPlaylistDisponibles = "SELECT p.idPlaylist, p.nombre, e.descripcion FROM playlist p JOIN estado e ON e.idEstado = p.codEstado WHERE p.codDueno = $idUsuario AND p.baneo = 0;";
					$resultadoBuscaTodasPlaylistDisponibles = mysqli_query( $db->conexion, $buscaTodasPlaylistDisponibles) or die("error al buscar todas mis Playlist.");
				}
				while($row = mysqli_fetch_assoc($resultadoBuscaTodasPlaylistDisponibles)){
					echo "<b><a href='miPlaylist.php?idPlaylist=". $row["idPlaylist"] ."'>". $row["nombre"] ."</a></b> " . $row["descripcion"] ."<br>";
					
				}
				
				echo "<div id='audio'></div>";
				$db->desconectar();
			
			?>
		</div>

	</div>
		
	<footer>
	</footer>

 	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>