<?php
	session_start();
?>

<html>

	<head>
		
	</head>
	
	<body>
	
		<?php
		if(isset($_SESSION["reg"]))	{
									if ($_SESSION["reg"]=="true"){
																 echo "Registro completo";
																 }
									}
		if(isset($_SESSION["habilitado"]))	{
											if($_SESSION["habilitado"] == "no")	{
																				echo "El usuario no se encuentra habilitado";
																				}	
											}
		?>
	
		<form method = "POST" action = "php/valida.php">
			
											
			<p> Ingrese su nombre </p>
			<input type = "text" name = "nombre" value = 
					<?php
					if(isset($_COOKIE["nombre"])) {
						$nombre = $_COOKIE["nombre"];
						echo "$nombre";
					}else 
						{
						echo "";
						}
					?>>
			</input> 
			<br>
			
			<p> Ingrese su clave </p>
			<input type = "password" name = "pass"></input>
			<br>
			
			<label> Recordarme </label>
			<input type = "checkbox" name = "recordar" value = "true"></input>
			<br>
			<br>
			
			<input type = "submit" value = "Ingresar">
			<input type = "reset" value = "Borrar">
			<br>
			
			
		</form>
		
		<a href = "html/registro.html"> Registrarse </a>
		<a href = "html/registro.html">
			<button>Registrarse</button>
		</a>
	</body>


</html>