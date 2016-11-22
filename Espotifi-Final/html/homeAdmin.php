<?php
session_start();
	
	if ($_SESSION['login'] == "on")
		{
		include_once('../clases/administrador.php');
		$_SESSION['admin'] = 'true';
		}else{
			 header('location: ../html/index.php'); 
			 }  
	
									
?>

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
	<script type="text/javascript" src="javaScript/funcionesAdministrador.js"></script>
	</head>
<body  onload="imageRandom()">
	
	<div id="principal" class="admin container">
		
		
		<?php
			administrador::listarDenuncias();
			administrador::listarTodos();
			administrador::listarBaneados();
		?>
		<a href='estadisticas.php'><input class="boton btn btn-success" type='button' value='Estadisticas' ></input></a>
		<a href='index.php'><input class="boton btn btn-success" type='button' value='salir' ></input></a>

		
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
	<script src="javaScript/imageRandom.js"></script>
</body>
</html>