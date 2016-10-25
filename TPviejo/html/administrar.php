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
	<form method = "post" action = "administrar.php">
				<input type = "text" name = "nombre"></input>
				<br>
				<br>
				<input type = "radio" name = "accion" value = "borrar">Borrar</input>
				<input type = "radio" name = "accion" value = "ver">Ver</input>
				<input type = "radio" name = "accion" value = "modificar">Modificar</input>
				<br>
				<input type = "submit"	 value = "Consultar"></input>
	</form>
	
</head>
			
</html>
			
<?php

include '../php/funciones.php';


$nombre = $_POST['nombre'];
$acc	= $_POST['accion'];

$link = conectar();
								
if($acc == "borrar")	{
						borrar($nombre, $link);
						}

if($acc == "ver")		{
						ver($nombre, $link);
						}

if($acc == "modificar")	{
						modificar($nombre, $link);
						}						
						
?>						