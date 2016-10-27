<?php
	session_start();
	
?>
<?php
	include('../clases/playlist.php');
?>



<html>
	<head>	
	

	</head>
	<body>
		<form method = "POST" action = "../php/crearPlaylist.php">	
			Crear playlist Nueva							
			<p> Nombre </p>
			<input type = "text" name = "nombre" /> 
			<br><br>
			<input type = "submit" name="accion" value = "crear" />		
		</form>	
		
		<form method = "POST" action = "../php/crearPlaylist.php">	
			Agregar canciones a la playlist: 
			<?php
				
				playlist::buscarPlaylist();  
				echo "<br>";
				 playlist::buscarCanciones();  
						
						
				
			?>
			<input type = "submit" name="accion" value = "agregar" />		
		</form>	
		
		
		<form method = "POST" action = "../php/crearPlaylist.php">	
			cambiar estado a la playlist: 
			<?php
				playlist::buscarPlaylist();  
						
				echo "<select name='estado'>"; 
				echo "<option value='1'>publica</option>";
				echo "<option value='2'>privada</option>"; 
				echo "<option value='3'>solo yo</option>"; 						
				echo "</select><br>";  		
			?>
			<input type = "submit" name="accion" value = "cambiar estado" />		
		</form>	
		
		<form method = "POST" action = "../php/crearPlaylist.php">	
			cambiar esquema de colores a la playlist: 
			<?php
				playlist::buscarPlaylist();  
						
				echo "<select name='esquema'>"; 
				echo "<option value='1'>rojo</option>";
				echo "<option value='2'>azul</option>"; 
				echo "<option value='3'>verde</option>"; 						
				echo "</select><br>";  		
			?>
			<input type = "submit" name="accion" value = "cambiar esquema" />		
		</form>	
		
		<form method = "POST" action = "../php/crearPlaylist.php">	
			cambiar genero a la playlist: 
			<?php
				playlist::buscarPlaylist();  
						
				playlist::listarGenerosPlaylist();   		
			?>
			<input type = "submit" name="accion" value = "cambiar genero de playlist" />		
		</form>	
		
		TOP 5 MÁS VOTADAS<br>
		<?php
		playlist::topCinco();
		?>
		
		
		<form method = "POST" action = "editarPlaylist.php">	
			Editar playlist [Nuevo]: 
			<?php
				
				playlist::buscarPlaylist();  

			?>
			<input type = "submit" name="accion" value = "editar [Nuevo]" />		
		</form>	
		
		
		
		

        
 
    

 
		
	</body>
</html>

