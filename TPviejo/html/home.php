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
				
		<h1>Bienvenido a la home</h1>
		
		<h2>Administrar Usuario</h2>
		<a href = "registro.php"> Alta </a>
		<br>
		<a href = "segunda.php"> Baja </a>
		<br>
		<a href = "administrar.php"> Modificacion </a>
		<br>
		<a href = "administrar.php"> Ver </a>
		<br>
		<a href = "segunda.php"> Segunda </a>
		<br>
		<a href = "logout.php"> Logout </a>	
		
	</body>

</html>
