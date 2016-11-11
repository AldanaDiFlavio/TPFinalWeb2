<?php
session_start();
?>

<?php 

	if ($_SESSION['login'] == "on")
		{
		
		}else{
			 header('location: ../index.php'); 
			 }  

include '../clases/database.php';

$nombre = $_SESSION['nombre'];
$db = new database();
$db->conectar();

$db->ver($nombre);			 
			 
			 
?>

<html>

	<head>
		
	</head>
	
	<body>
		<a href = "home.php">  Volver  </a>
		<a href = "administrar.php">  Modificacion  </a>
		<a href = "logout.php">  Logout  </a>	
		<br>
		
		<form method = "POST" action = "modificar.php">
			
			<p>Ingrese su nuevo correo</p>
			<input type = "text" name = "email" ></input>
			<p>Ingrese su nueva contraseña</p>
			<input type = "password" name = "pass1" ></input>
			<br>
			<p>Repita su nueva contraseña</p>
			<input type = "password" name = "pass2" ></input>
			<br>
			
			<input type = "submit" value = "Aceptar">
			
		</form>

	</body>

</html>	
			
<?php

$newEmail = $_POST["email"];
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];

echo $nombre;
echo $newEmail;
echo $pass1;
echo $pass2;

if($pass1 == $pass2){
					$newPass = $pass2;
					$db->modificar($nombre,$newEmail,$newPass);
					}
					else{echo "Las contraseñas no coinciden";}
					
?>						