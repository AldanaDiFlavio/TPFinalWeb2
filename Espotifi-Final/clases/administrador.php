<?php
include_once('db.php');

class administrador {
			
			private $idAdmin;
			
			public function __construct($idAdmin)
										{
										$this->idAdmin = $idAdmin;										
										}
			
		
			public static function listarDenuncias(){
				$db = new BaseDatos();
				if($db->conectar()){
					$denuncias = "SELECT DISTINCT u.idUsuario, u.nombre, u.email, u.fecha_creacion FROM usuario u JOIN denuncias d ON d.codDenunciado = u.idUsuario;";
					$resultado = mysqli_query( $db->conexion, $denuncias) or die("Error al listar denuncias.");	
					
					
				}
				
				echo "<b>Todos los denunciados</b><table>
						<tr>
							<th>ID Denunciado </th>
							<th>Nombre</th> 
							<th>email</th>
							<th>fecha de creacion</th>
							<th>nombres inapropiados</th>
							<th>copia playlist</th>
						</tr>";
				while ($row = mysqli_fetch_assoc($resultado)){   
					echo "
					<tr>
						<td>". $row['idUsuario'] ."</td>
						<td>". $row['nombre'] ."</td>
						<td>". $row['email'] ."</td>
						<td>". $row['fecha_creacion'] ."</td>";
						 
						$motivo1 = "SELECT count(d.codDenunciado) dc FROM denuncias d WHERE d.codDenunciado = ". $row['idUsuario'] ." AND d.Codmotivo = 1 ;";
						$resultadomotivo1 = mysqli_query( $db->conexion, $motivo1) or die("Error al listar mostrarMotivos.");
						while ($row1 = mysqli_fetch_assoc($resultadomotivo1)){
							echo "<td>". $row1['dc'] ."</td>";
						}
						$motivo2 = "SELECT count(d.codDenunciado) dc FROM denuncias d WHERE d.codDenunciado = ". $row['idUsuario'] ." AND d.Codmotivo = 0 ;";
						$resultadomotivo2 = mysqli_query( $db->conexion, $motivo2) or die("Error al listar mostrarMotivos.");	
						while ($row2 = mysqli_fetch_assoc($resultadomotivo2)){
							echo "<td>". $row2['dc'] ."</td>";
						}
						echo "<td><a href='home.php?idUsuario=". $row["idUsuario"] ."'  target='_blank'><span class='glyphicon glyphicon-user'></span></a></td>";
						echo "<td><a onclick='banearPerfil(". $row["idUsuario"] .");' href=''><span class='glyphicon glyphicon-ban-circle' ></a></span></td>";						
					echo "</tr> ";				
				}  
				echo "</table>";
				$db->desconectar();
			}
			
			
			public static function listarTodos(){
				$db = new BaseDatos();
				if($db->conectar()){
					$denuncias = "SELECT u.idUsuario, u.nombre, u.email, u.fecha_creacion FROM usuario u WHERE u.administrador = 'false' AND habilitado = 'true';";
					$resultado = mysqli_query( $db->conexion, $denuncias) or die("Error al listar denuncias.");	
				}
				
				echo "<b>Todos los usuarios</b><table>
						<tr>
							<th>ID Usuario </th>
							<th>Nombre</th> 
							<th>email</th>
							<th>fecha de creacion</th>
						</tr>";
				while ($row = mysqli_fetch_assoc($resultado)){   
					echo "
					<tr>
						<td>". $row['idUsuario'] ."</td>
						<td>". $row['nombre'] ."</td>
						<td>". $row['email'] ."</td>
						<td>". $row['fecha_creacion'] ."</td>
						<td><a href='home.php?idUsuario=". $row["idUsuario"] ."' target='_blank'><span class='glyphicon glyphicon-user'></a></span></td>
						<td><a onclick='banearPerfil(". $row["idUsuario"] .");' href=''><span class='glyphicon glyphicon-ban-circle'></span></a></td>						
					</tr> ";				
				}  
				echo "</table>";
				
			
			}
			
			public static function listarBaneados(){
				$db = new BaseDatos();
				if($db->conectar()){
					$baneados = "SELECT u.idUsuario, u.nombre, u.email, u.fecha_creacion FROM usuario u WHERE u.habilitado = 'false';";
					$resultado = mysqli_query( $db->conexion, $baneados) or die("Error al listar baneados.");	
				}
				$db->desconectar();
				echo "<b>Todos los baneados o pendientes de habilitacion</b><table>
						<tr>
							<th>ID Usuario </th>
							<th>Nombre</th> 
							<th>email</th>
							<th>fecha de creacion</th>
						</tr>";
				while ($row = mysqli_fetch_assoc($resultado)){ 
					echo "
						<tr>
						<td>". $row['idUsuario'] ."</td>
						<td>". $row['nombre'] ."</td>
						<td>". $row['email'] ."</td>
						<td>". $row['fecha_creacion'] ."</td>
						<td><a href='home.php?idUsuario=". $row["idUsuario"] ."' target='_blank'><span class='glyphicon glyphicon-user'></a></span></td>
						<td><a onclick='habilitarPerfil(". $row["idUsuario"] .");' href=''><span class='glyphicon glyphicon-ok-circle'></span></a></td>						
						</tr> ";				
				}  
				echo "</table>";				
			}
			
}		
	
?>