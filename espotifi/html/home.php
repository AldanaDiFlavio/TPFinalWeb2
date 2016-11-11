<?php
session_start();
?>

<?php 
	include '../clases/database.php';
	
	if ($_SESSION['login'] == "on")
		{
		
		}else{
			 header('location: ../index.php'); 
			 }  

	
	$db = new database();
	$db->conectar();
	//para ver/ocultar perfil, funciona como flag.
	$_SESSION["perfil"] = "mostrar";								
?>

<html>

	<head>
				
		<script>//se pueden poner los script en un archivo externo?
			function verPerfil(){
								
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("perfil").innerHTML = this.responseText;
												}
										};
								
								//xhttp.open("GET", "../php/ver.php?nombre="(porque hay que usar un + para concatenar?)+nombre, "true");
								xhttp.open("GET", "../php/verperfil.php", "true");
								xhttp.send();
								
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("mostrar").innerHTML = this.responseText;	
												}
										};
								xhttp.open("GET", "../php/botonVer.php" , "true");
								xhttp.send();
								}
								
			function seguir(siguiendo)	{
								
								//seguir a un usuario
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("seguir").innerHTML = this.responseText;
												}
										};
														
								xhttp.open("GET", "../php/seguir.php?siguiendo="+siguiendo, "true");
								xhttp.send();
								
								//a quien sigue								
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("siguiendoA").innerHTML = this.responseText;	
												}
										};
								xhttp.open("GET", "../php/siguiendoA.php" , "true");
								xhttp.send();											
								
								}
		function escribeMotivo(usuario_denunciado)
						{
						/*
						var us = usuario_denunciado;
						var mo = motivo_denuncia;
						document.writeln(us,mo); 
						*/
						xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function()	
								{
								if (this.readyState == 4 && this.status == 200)
										{
										document.getElementById("denuncias").innerHTML = this.responseText;	
										}
								};
						xhttp.open("GET", "../php/escribeMotivo.php?usuario_denunciado="+usuario_denunciado, "true");
						xhttp.send();	
						}
						
		function denunciar(usuario_denunciado,motivo_denuncia)
						{
						
						xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function()	
								{
								if (this.readyState == 4 && this.status == 200)
										{
										document.getElementById("denuncias").innerHTML = this.responseText;	
										}
								};
						xhttp.open("GET", "../php/denunciar.php?usuario_denunciado="+usuario_denunciado+"&motivo_denuncia="+motivo_denuncia, "true");
						xhttp.send();	
						
						}								

		</script>
		
		
	</head>
	
	<body>
				
		<h1>Bienvenido a la home</h1>
		
		<div>		
				<h2>Hola <?php echo $_SESSION['nombre']; ?> </h2>
				<br>
				
				<div id = "mostrar">
					<button type = "button" onclick = "verPerfil()" >Ver Perfil</button>
				</div>	
				
				<div id = "perfil">
				</div>
			
				<a href = "registro.php"> Alta </a>
				<br>
				<a href = "segunda.php"> Baja </a>
				<br>
				<a href = "modificar.php"> Modificacion </a>
				<br>
				<a href = "segunda.php"> Segunda </a>
				<br>
				<a href = "logout.php"> Logout </a>	
		</div>
		
		<div>
			<form method = "POST" action = "home.php">
				<h4>Buscar usuario</h4>
				<input type = "text" name = "nombre"></input>
				<input type = "submit" value = "Buscar">
			</form>
			
			<?php

			if(isset($_POST['nombre']))
					{
					$nombre = $_POST['nombre'];
					$db = new database();
					$db->conectar();
					$db->ver($nombre);
					}
					
			?>
					
		</div>
		
		<div id = "siguiendoA">
			<?php
			$usuario = $_SESSION['nombre'];
			$db->siguiendoA($usuario);
			?>
		</div>
		
		<div id = "seguir">
			<?php
			$db->paraSeguir();
			?>		
		</div>
	
	
		<div id = "denuncias">
		
		</div>
		
	</body>

</html>
