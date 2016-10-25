<?php
session_start();
?>

<?php

  	if ($_SESSION['login'] == "on")
		{
		
		}else{
			 header('location: ../index.php'); 
			 }  

?>

<html>

	<head>
		
	</head>
	
	<body>
		
		<h1>Bienvenido a la segunda</h1>
		
		<h2>Dar de baja una cuenta</h2>
			<form method = "post" action = "administrar.php">
				
				<input type = "text" name = "nombre"></input>
				<br>
				<input type = "checkbox" name = "borrar" value = "true">
				<br>
				<input type = "submit" value = "Borrar usuario"></input>
			</form>
		
		
		
		<a href = "logout.php"> Logout </a>	
		
	</body>

</html>

<?php
	/*
	if(($_SESSION['nombre'] == $_COOKIE["nombre"]) && ($_SESSION['pass'] == $_COOKIE["password"]))
		{
		
		}
		else{
			header('location: index.php');
			} 
	*/
  	if ($_SESSION['login'] == "on")
		{
		
		}else{
			 header('location: index.php'); 
			 }  
?>
