<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Espotifí</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJD_N_jOh_hh32hRQVqPr0Ch14ghe42g0&callback=initMap" type="text/javascript"></script>
	<script>
		function loadMap(){
			var mapOptions = {
				center:new google.maps.LatLng(-34.6686986,-58.5614947),	zoom:12, mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);
		}
				
	</script>
</head>
<body  onload="imageRandom(); loadMap()">
	<div class="encabezado">
		<div class="container">
		<div class="logo col-md-9">
			<a href="index.php"><img src="../imagenes/espotifi-logo.png" alt="Espotifí"></a>
		</div>
		</div>
	</div>
	<section>
		<div class="container">
			<h1>Registrate</h1>
				<div class="formulario">
					<form class="form" method = "post" action = "../php/altausuario.php">
						<div class="col-md-6">
							<input class="form-control" name="nombre" type="text" placeholder="Nombre de usuario" />
							<br/>
							<input class="form-control" name="pass1" type="password" placeholder="ingrese la contraseña" />
							<br/>
							<input class="form-control" name="pass2" type="password" placeholder="ingresela nuevamente" />
							</br>
							<input class="form-control" name="email" type="text" placeholder="ejemplo@mail.com" />
							<br/>
							<button type="submit" class="btn btn-success" value="Aceptar">¡Registrate!</button>
						</div>
						<div class="col-md-6">
							<div class="img-responsive mapa" id ="mapa" style = "width: 450px; height: 350px;"></div>
						</div>
					</form>
				</div>
		</div>
	</section>	
	<footer>
		<div class="container">		
			<img class="center-block" src="../imagenes/espotifi-iso.png" alt="Espotifi" width="25px">
			<div class="row">
				<div class="col-md-4 col-md-offset-5">
					<p>Espotifi - Programación Web 2 </p>				
				</div>
			</div>
		</div>
	</footer>
	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	<script src="javaScript/imageRandom.js"></script>

</body>
</html>