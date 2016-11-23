<?php
	session_start();
	if ($_SESSION['login'] == "on")
		{
		include_once('../clases/db.php');
		include_once('../clases/usuario.php');
	
		if(isset($_REQUEST['alerta'])){
			echo "<script type='text/javascript'>alert('". $_REQUEST['alerta'] ."');</script>";
		}
		}else{
			 header('location: ../html/index.php'); 
			 }  

		$usuarioSession = new usuario($_SESSION['idUsuario']);
		$nombreSession = $usuarioSession->armarUsuario();
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
	<script type="text/javascript" src="javaScript/funcionesCancion.js"></script>
</head>
	<body onload="imageRandom()">
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
						
					</ul>
					
					<form action="" class="navbar-form navbar-left" role="search">
					
						<div id="buscador" style="color: white;" class="form-group">
							<input name="busqueda" type="text" class=" buscador form-control " placeholder="Buscá Playlist o Usuarios" onkeyup="realizarBusqueda(this.value, <?php echo $_SESSION['idUsuario']; ?>);">
							<input type="radio" name="filtroPrimario" checked value="filtroUsuario" onchange="habilitaFiltros()">usuario
							<input type="radio" name="filtroPrimario" value="filtroPlaylist" onchange="habilitaFiltros()">playlist
							<select id="filtrosPlaylist" name="filtrosPlaylist" style="color:black; display:none;" onchange="realizarBusqueda(busqueda.value, <?php echo $_SESSION['idUsuario']; ?>);">
							  <option value="nombre" selected>nombre</option>
							  <option value="genero">genero</option>
							  <option value="creador">creador</option>
							</select>
						</div>
						
					</form>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><img src="../imagenes/sin-título-5.jpg" alt="Perfil" width="30px" class="img-circle" title="Perfil"></a></li>
						<li><a class="usuario" title="Perfil" ><?php  echo $nombreSession; ?></a></li>
						<li><a href="index.php" class="salir" title="salir">salir</a></li>
						<li><a href="#"></a></li>
					</ul>
				
				</div>	
				
			</div>
				
		</nav>
			<h1 class="h1">Subí tu canción</h1>
		<div class="subecancion container">
			<div class="row">
			<div class="col-md-7 col-md-offset-4">
			<form action="FuncionesCancion.php?funcion=subirCancion" method="post" enctype="multipart/form-data">
				<br/><br/>
				<input class="form-control" id="album" onkeyup="validaForm()" type="text" name="album" placeholder="Álbum"><br>
				<input class="form-control" id="artista" onkeyup="validaForm()" type="text" name="artista" placeholder="Artista"><br>
				<label>Genero:</label>
				<?php
					$db1 = new BaseDatos();
					if($db1->conectar()){
						$buscarGenerosCancion = "SELECT idGenero, descripcion FROM generoCanciones;";
						$generosCanciones = mysqli_query( $db1->conexion, $buscarGenerosCancion) or die("error al buscar los generos de Canciones.");
					}
					echo "<select id='generos' name='generos'>";
					while($row2 = mysqli_fetch_assoc($generosCanciones)){
						echo "<option value='". $row2["idGenero"] ."'>". $row2["descripcion"] ."</option>";
					}
					echo "</select><br><br>";

					$db1->desconectar();
					
				?>
				<input name="file" type="file" /><br/><input id="submit" class="boton btn btn-success" type="submit" value="Subir audio" disabled="true" />
				<?php 
								echo "<a href='home.php?idUsuario=". $_SESSION['idUsuario'] ."'><input class='boton btn btn-success' id='volver' type='button' value='Volver' ></input></a><br><br>";

				?>
			</form>
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
	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="javaScript/imageRandom.js"></script>

	</body>

</html>