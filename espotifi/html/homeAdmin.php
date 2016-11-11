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
		
		<script>
			function banear(nombre){
								
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("listUser").innerHTML = this.responseText;
												}
										};
								
								xhttp.open("GET", "../php/banear.php?nombre="+nombre, "true");
								xhttp.send();
								
								}
			
			function verDenuncias(nombre){
								
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("verDenuncias").innerHTML = this.responseText;
												}
										};
								
								xhttp.open("GET", "../php/verDenuncias.php?nombre="+nombre, "true");
								xhttp.send();
								
								}	
			
			function exportarPDF(nombre){
								
								
								/*
								xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function()	
										{
										if (this.readyState == 4 && this.status == 200)
												{
												document.getElementById("verDenuncias");
												}
										};
								xhttp.open("GET", "../php/exportarPDF.php?nombre="+nombre, "true");
								xhttp.send();
								*/
								}								
		</script>
		
		
	</head>
	
	<body>
		<a href = "logout.php"> Logout </a>			
		<div id="listUser">
			<?php
			include '../clases/database.php';
			$nombre = $_SESSION['nombre'];
			$db = new database();
			$db->conectar();
			$db->listarUsuarios();
			?>
			
		</div>
		<div id="verDenuncias">
		
		</div>
	</body>

</html>
