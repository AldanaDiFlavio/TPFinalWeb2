<?php
	include_once('db.php');
	
	class usuario {
				
				private $idUsuario;
				
				public function __construct($idUsuario)
											{
											$this->idUsuario = $idUsuario;										
											}
				

		public function armarUsuario(){
			$db = new BaseDatos();			
			if($db->conectar()){
					$buscaUsuario = "SELECT * FROM usuario WHERE idUsuario = $this->idUsuario;";
					$resultado = mysqli_query ( $db->conexion, $buscaUsuario) or die ("Fallo la busqueda del usuario.");	
					while ($row = mysqli_fetch_assoc($resultado)){ 
							return "$row[nombre]";
					}
			}
			$db->desconectar();	
					
		}
		
		public static function listarMisSeguidores($idUsuario){
			$db = new BaseDatos();
			if($db->conectar()){
				$buscarMisSeguidores = "SELECT u.idUsuario, u.nombre FROM usuario u WHERE u.habilitado LIKE 'true' AND u.idUsuario IN (SELECT idUsuarioJefe FROM sigue WHERE idUsuarioSeguidor = $idUsuario);";
				$resultado = mysqli_query( $db->conexion, $buscarMisSeguidores) or die("error al listar mis seguidores.");
				echo "<ul>";
				while($row = mysqli_fetch_assoc($resultado)){
					echo "<li><a href='home.php?idUsuario=". $row["idUsuario"] ."'>". $row["nombre"] ."</a></li>";
				}
				echo "</ul>";
				
			$db->desconectar();				
			}
		}
		
			Public static function cantidadSeguidores($idUsuario){
			$db = new BaseDatos();
			if($db->conectar()){
				$buscarMisSeguidores = "Count * FROM ;";
				$resultado = mysqli_query( $db->conexion, $buscarMisSeguidores) or die("error al listar mis seguidores.");
				echo "<ul>";
				while($row = mysqli_fetch_assoc($resultado)){
					echo "<li><a href='home.php?idUsuario=". $row["idUsuario"] ."'>". $row["nombre"] ."</a></li>";
				}
				echo "</ul>";
				
			$db->desconectar();				
			}
		}
	}
?>

					