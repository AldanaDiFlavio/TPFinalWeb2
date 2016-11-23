<?php
	include_once ("../../clases/db.php");
	include_once ("../../jpgraph-4.0.1//src/jpgraph.php"); 
	include_once ("../../jpgraph-4.0.1/src/jpgraph_pie.php");
	include_once ("../../jpgraph-4.0.1/src/jpgraph_pie3d.php");

	$db = new BaseDatos();
	
	if($db->conectar()){
		/*$contarPlaylist = "SELECT count(*) cp FROM playlist WHERE fecha_creacion BETWEEN '2016-01-01' AND '2017-01-01';";
		$resultadoContarPlaytlist = mysqli_query( $db->conexion, $contarPlaylist) or die("error al buscar fechas.");	
		$contarPlaylist = mysqli_fetch_assoc($resultadoContarPlaytlist);
		echo $contarPlaylist['cp'];*/
	
		/*$playlistCR = "SELECT p.idPlaylist, p.nombre, p.cantidad_reproducciones FROM playlist p;";
		$resultadoPlaylistCR = mysqli_query( $db->conexion, $playlistCR) or die("error al buscar fechas.");	*/
		
		//Usuarios Baneados
		$usuariosBaneados = "SELECT count(*) cb FROM usuario WHERE habilitado = 'false'";
		$resultado1 = mysqli_query( $db->conexion, $usuariosBaneados) or die("error.");	
		$usuariosBaneados = mysqli_fetch_assoc($resultado1);
		
		$usuariosTotal = "SELECT count(*) cu FROM usuario WHERE habilitado = 'true'";
		$resultado2 = mysqli_query( $db->conexion, $usuariosTotal) or die("error.");	
		$usuariosTotal = mysqli_fetch_assoc($resultado2);
		
		
		$data[0] = $usuariosBaneados["cb"];
		$data[1] = $usuariosTotal["cu"];
		  

		$graph = new PieGraph(450,200,"auto"); 
		$graph->img->SetAntiAliasing(); 

		//$graph->SetShadow(); 

		// Setup margin and titles 
		$graph->title->Set("Usuarios baneados/habilitados."); 

		$p1 = new PiePlot3D($data); 
		$p1->SetSize(0.35); 
		$p1->SetCenter(0.5); 

		// Setup slice labels and move them into the plot 
		$p1->value->SetFont(FF_FONT1,FS_BOLD); 
		$p1->value->SetColor("black"); 
		$p1->SetLabelPos(0.2); 

		$nombres=array("Total de baneados","Total de habilitados"); 
		$p1->SetLegends($nombres); 

		// Explode all slices 
		$p1->ExplodeAll(); 

		$graph->Add($p1); 
		$graph->Stroke(); 
		//fin Usuarios Baneados	
	
	

//crear imagen
$graph->Stroke(_IMG_HANDLER);

$fileName = "graficoUsuariosBaneados.png";
$graph->img->Stream($fileName);

// Mandarlo al navegador
$graph->img->Headers();
$graph->img->Stream();
	
	
	
	
	
	
	
	
	
	
	
	
	}
	$db->desconectar();
?>