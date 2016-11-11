<?php
	session_start();
?>

<html>

	<head>
		
	</head>
	
	<body>
	
		<?php
		if(isset($_SESSION["reg"]))	{
									if ($_SESSION["reg"]=="true")	{
																	$_SESSION["reg"]="false";
																	echo "Registro completo, verifique su correo para terminar el registro";
																	}
									}
		if(isset($_SESSION["habilitado"]))	{
											if($_SESSION["habilitado"] == "false")	{
																					$_SESSION["habilitado"] = "true";
																					echo "El usuario no se encuentra habilitado";
																					}	
											}
		if(isset($_SESSION["valida"]))	{
										if ($_SESSION["valida"]=="true")	{
																			$_SESSION["valida"]="false";
																			echo "El usuario o contrasena son incorrectos";
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
			<input type = "password" name = "contrasena"></input>
			<br>
			
			<label> Recordarme </label>
			<input type = "checkbox" name = "recordar" value = "true"></input>
			<br>
			<br>
			
			<input type = "submit" value = "Ingresar">
			<input type = "reset" value = "Borrar">
			<br>
			
			
		</form>
		
		<a href = "html/registro.php"> Registrarse </a>
		
	</body>


</html>