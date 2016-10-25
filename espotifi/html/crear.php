<?php
	include('../clases/playlist.php');
?>



<html>
	<head>	
	</head>
	<body>
		<form method = "POST" action = "crearPlaylist.php">	
			Crear playlist Nueva							
			<p> Nombre </p>
			<input type = "text" name = "nombre" /> 
			<br><br>
			<input type = "submit" name="accion" value = "crear" />		
		</form>	
		
		<form method = "POST" action = "crearPlaylist.php">	
			Agregar canciones a la playlist: 
			<?php
				
				playlist::buscarPlaylist();  
				echo "<br>";
				playlist::buscarCanciones();  
						
						
				
			?>
			<input type = "submit" name="accion" value = "agregar" />		
		</form>	
		
		
		<form method = "POST" action = "crearPlaylist.php">	
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
		
		<form method = "POST" action = "crearPlaylist.php">	
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
		
		<form method = "POST" action = "crearPlaylist.php">	
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
		<html>
    <head>
        <title>Ejemplon</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    </head>
        <script type="text/javascript">
            $( function (){
 
                $("#enviar").click( function (){
                    $('#datos option:selected').appendTo("#recibe");
                });
                
            });
        </script>
    <body>
        <select id="datos">
            <option>Uno</option>
            <option>Dos</option>
            <option>Tres</option>
            <option>Cuatro</option>
            <option>Cinco</option>
            <option>Seis</option>
        </select>
        <button id="enviar">Enviar</button>
        <select id="recibe"></select>
 
    </body>
</html>
 
		
	</body>
</html>

