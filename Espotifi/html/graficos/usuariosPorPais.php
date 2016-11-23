<?php
	include_once ("../../clases/db.php");
	include_once ("../../jpgraph-4.0.1//src/jpgraph.php"); 
	include_once ("../../jpgraph-4.0.1/src/jpgraph_pie.php");
	include_once ("../../jpgraph-4.0.1/src/jpgraph_pie3d.php");

	$db = new BaseDatos();
	
	if($db->conectar()){
		

		
		$buscaPais = "SELECT pais, COUNT(*) cu FROM usuario GROUP BY pais;";
		$resultado1 = mysqli_query( $db->conexion, $buscaPais) or die("error.");	
		
		$i = 0;
		while ($row = mysqli_fetch_assoc($resultado1)){    
			  $data[$i] = $row["cu"];
			  $nombres[$i] = $row["pais"]; 
			  $i = $i + 1;
		}
		  

		$graph = new PieGraph(450,200,"auto"); 
		$graph->img->SetAntiAliasing(); 

		//$graph->SetShadow(); 

		// Setup margin and titles 
		$graph->title->Set("Usuarios por pais."); 

		$p1 = new PiePlot3D($data); 
		$p1->SetSize(0.35); 
		$p1->SetCenter(0.5); 

		// Setup slice labels and move them into the plot 
		$p1->value->SetFont(FF_FONT1,FS_BOLD); 
		$p1->value->SetColor("black"); 
		$p1->SetLabelPos(0.2); 

		//$nombres=array("Total de baneados","Total de habilitados"); 
		$p1->SetLegends($nombres); 

		// Explode all slices 
		$p1->ExplodeAll(); 

		$graph->Add($p1); 
		$graph->Stroke(); 
			
//crear imagen
$graph->Stroke(_IMG_HANDLER);

$fileName = "usuariosPorPais.png";
$graph->img->Stream($fileName);

// Mandarlo al navegador
$graph->img->Headers();
$graph->img->Stream();

	
	}
	$db->desconectar();
?>