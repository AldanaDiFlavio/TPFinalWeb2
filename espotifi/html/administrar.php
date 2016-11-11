<?php
session_start();
?>

<?php 

	if ($_SESSION['login'] == "on")
		{
		
		}else{
			 header('location: ../index.php'); 
			 }  

$nombre = $_SESSION['nombre'];
echo $nombre;			 
?>

<html>

<head>
</head>

<body>
	<form method = "post" action = "administrar.php">
				<input type = "text" name = "nombre"></input>
				<br>
				<br>
				<input type = "radio" name = "action" value = "borrar">Borrar</input>
				<input type = "radio" name = "action" value = "ver">Ver</input>
				<input type = "radio" name = "action" value = "modificar">Modificar</input>
				<br>
				<input type = "submit"	 value = "Consultar"></input>
	</form>
	
</head>
			
</html>
			
<?php

include '../clases/database.php';

$nombre = $_POST['nombre'];
$act	= $_POST['action'];
$db = new database();
$db->conectar();

								
if($act == "borrar")	{
						borrar($nombre);
						}

if($act == "ver")		{
						
						$db->ver($nombre);
						}

if($act == "modificar")	{
						modificar($nombre);
						}						
						
?>						