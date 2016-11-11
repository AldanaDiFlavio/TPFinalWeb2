<?php
session_start();
?>

<?php

$value = '"<?php echo $_SESSION["nombre"]; ?>';

if ($_SESSION["show"] == "ocultar")	
	{
	$_SESSION["show"] = "ver";
	echo '<button type = "button" onclick = "verPerfil(this.value)" value ='.$value.' Ocultar Perfil </button>';
	}
	else if($_SESSION["show"] == "ver")
		{
		$_SESSION["show"] = "ocultar";
		echo '<button type = "button" onclick = "verPerfil(this.value)" value ='.$value.' Ver Perfil </button>';		
		}

?>
