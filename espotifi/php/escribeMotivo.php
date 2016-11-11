
<?php
	
	$usuario_denunciado = $_GET['usuario_denunciado'];

		
	echo '<form method="get" name="formulario" action="../php/denunciar.php"';
	echo 'Motivo<br>';
	echo '<input type="text" name="motivo_denuncia">';
	echo '<br>';
	echo '<input type="text" name="usuario_denunciado" value ="'.$usuario_denunciado.'">';
	echo '<input type="submit" value="Enviar">';
	
	
	

?>