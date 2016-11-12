<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Espotifí</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="shortcut icon" type="image/x-icon" href="Imagenes/espotifi.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body  onload="imageRandom()">
<div class="encabezado">
		<div class="container">
		<div class="logo col-md-9">
			<a href="index.php"><img src="imagenes/espotifi-logo.png" alt="Espotifí"></a>
		</div>
		<div class="registro col-md-3">
			<a href="registro.php">Registrate</a>
			<a href="#login" data-toggle="modal">Iniciá Sesión</a>
			
			<div class="modal fade" id="login">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
						<div><img src="imagenes/espotifi-iso.png" class="center-block" width="25px"></div>
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
		<h1>Registrate</h1>
			<div class="formulario">
				<form class="form center-block" action="#">
					<h3>Nunca le faltará música a tu vida</h3>				
					<input class="form-control" type="text" name="nombreUsuario" placeholder="Nombre de usuario">	
					<input class="form-control" type="email" name="email" placeholder="E-mail">						
					<input class="form-control" type="password" name="contraseña" placeholder="Contraseña">	
					<input class="form-control" type="password" name="verificarContraseña" placeholder="Repita su Contraseña">
					<a href="home.php"><button type="button" class="btn btn-success">Registrate</button></a>
				</form>
			</div>

		</div>
	</section>
	<footer>
	</footer>
	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	<script src="js/imageRandom.js"></script>

</body>
</html>