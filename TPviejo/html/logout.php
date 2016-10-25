<?php
	session_start();
?>

<?php
		
	if ($_SESSION["login"] == "on")
		{
		session_destroy();
		$_SESSION["login"] 	= "off";
		$_SESSION["reg"]	= "false";
		}
		else{
			header('location: ../index.php');
			} 
?>



<html>

	<head>
		
	</head>
	
	<body>
	
		<h1>Sesion finalizada</h1>
		
	</body>


</html>