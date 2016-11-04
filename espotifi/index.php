<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Espotifí</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
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
			var strURL="php/reproduceCancion.php?canciones="+canciones;
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
	</script>
	
</head>
<body  onload="imageRandom()">
	<div class="encabezado ">
		<div class="container">
		<div class="logo col-md-9">
			<a href="index.php"><img src="imagenes/espotifi-logo.png" alt="Espotifí" title="Espotifí"></a>
		</div>
		<div class="registro col-md-3">
			<div class="pull-right">
			<a href="registro.php">Registrate</a>
			<a href="#login" data-toggle="modal">Iniciá Sesión</a>
			</div>
			<div class="modal fade" id="login">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
						<div><img src="imagenes/espotifi-iso.png" class="center-block" width="25px;"></div>
							<form action="#">
								<input class="form-control" type="text" placeholder="Nombre de usuario">
								<br/>
								<input class="form-control" type="password" placeholder="Contraseña">
							</form>
						</div>
						<div class="modal-footer">
							<a href="home.php"><button type="button" class="btn btn-success">Iniciá Sesión</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	
	<section>
		<div class="container">
			<div class="col-md-7">
				<h1>Top 5 <span class="glyphicon glyphicon-heart"></span></h1>
				<div id="musicPlayer">
					<div class="row">
					
						<div id="musicLists" >
							<div class="panel with-nav-tabs panel-default">
								<div class="panel-heading">
									<ul class="nav nav-tabs">
										<?php
										include_once('/clases/db.php');
										$db = new BaseDatos();
											if($db->conectar()){
												$buscarTop5 = "SELECT idPlaylist id, nombre, cantidad_votos FROM playlist ORDER BY cantidad_votos DESC LIMIT 0,5;";
												$top5 = mysqli_query( $db->conexion, $buscarTop5) or die("No se pudo conectar.");
											}
										$db->desconectar();
										$contador = 1;
										while($fila1 = mysqli_fetch_assoc($top5)){
											echo "<li><a href='#tab$contador' data-toggle='tab'>" . $fila1["nombre"] . "</a></li>";
											$contador++;
										}
										echo "<div id='audio'></div>";
										$contador = 1;
										?>
									</ul>
								</div>
								<div class="panel-body">
									<div class="tab-content">
										<?php	
											$db2 = new BaseDatos();
												if($db2->conectar()){
													$buscarCincoMejores = "SELECT idPlaylist id FROM playlist ORDER BY cantidad_votos DESC LIMIT 0,5;";
													$resultado = mysqli_query( $db2->conexion, $buscarCincoMejores) or die("No se pudo conectar.");
												}
											$db2->desconectar();
											$contador = 1;
											while($fila = mysqli_fetch_assoc($resultado)){
												echo "<div class='tab-pane fade' id='tab$contador'>";
												$contador++;
												echo "<div class='row'>
													<div>
													<table class='table table-striped custab'>
													<thead>
														<tr>
															<th>Titulo</th>
															<th>Artista</th>
															<th>Album</th>
															<th></th>
														</tr>
													</thead>";
												$db3 = new BaseDatos();
												if($db3->conectar()){
													$sql = "SELECT can.idCancion id, can.titulo, can.artista, can.album, can.path FROM cancion can JOIN contiene con ON can.idCancion = con.codCancion WHERE baneo = 0 AND con.codPlaylist =" . $fila['id'] ;
													$resultado2 = mysqli_query($db3->conexion, $sql);
												}
												$db3->desconectar();													
												while($row = mysqli_fetch_assoc($resultado2)){
													echo "<tr>
														<td>" . $row["titulo"] . "</td>
														<td>" . $row["artista"] . "</td>
														<td>" . $row["album"] . "</td>
														<td><a  onclick='reproduceCancion(" . $row["id"] . ")'><span class='glyphicon glyphicon-play-circle'></span></a></td>
													</tr>";
												}
												
												
												echo "			</table>
															</div>	
														</div>
													</div>";
											} 
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-5">
				<div class="pull-right">
				<h1>Registrate<br/>para<br/>más <a href="registro.php"><span class="glyphicon glyphicon-menu-right"></span></a></h1>
				</div>
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
	<footer>
		<div class="container">		
			<img class="center-block" src="imagenes/espotifi-iso.png" alt="Espotifi" width="25px">
			<div class="row">
				<div class="col-md-4">
					<p> </p>				
				</div>
				<div class="col-md-4 col-md-offset-1">
					<p>Espotifi - Programación Web 2 </p>				
				</div>
				<div class="col-md-4">
					<p> </p>				
				</div>
			</div>
	</footer>
	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="js/imageRandom.js"></script>
</body>
</html>