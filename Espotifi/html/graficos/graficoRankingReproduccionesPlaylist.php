<?php
	include_once ("../../clases/db.php");
	include_once ("../../jpgraph-4.0.1//src/jpgraph.php"); 
	include_once ("../../jpgraph-4.0.1/src/jpgraph_bar.php");
	
	$db = new BaseDatos();
	
	if($db->conectar()){
		
		$votos = "SELECT idPlaylist, cantidad_votos FROM playlist";
		$resultadoVotos = mysqli_query( $db->conexion, $votos) or die("error.");	
		
		$i=0;
		while ($row = mysqli_fetch_assoc($resultadoVotos)){    
			$datax[$i] = $row['idPlaylist'];   
			$datay[$i] = $row['cantidad_votos'];   
			$i++;
		}  	
		
			
		/*$datay=array(2,3,5,8,12,6,3);
		$datax=array('Jan','Feb','Mar','Apr','May','Jun','Jul');*/
		 
		// Size of graph
		$width=400;
		$height=300;
		 
		// Set the basic parameters of the graph
		$graph = new Graph($width,$height,'auto');
		$graph->SetScale('textlin');
		 
		// Rotate graph 90 degrees and set margin
		$graph->Set90AndMargin(50,20,50,30);
		 
		// Nice shadow
		$graph->SetShadow();
		 
		// Setup title
		$graph->title->Set('Cantidad de votos por Playlist.');
		
		 
		// Setup X-axis
		$graph->xaxis->SetTickLabels($datax);
		
		 
		
		 
		// Label align for X-axis
		$graph->xaxis->SetLabelAlign('right','center');
		 
		// Add some grace to y-axis so the bars doesn't go
		// all the way to the end of the plot area
		$graph->yaxis->scale->SetGrace(20);
		 
		
		 
		// Now create a bar pot
		$bplot = new BarPlot($datay);
		$bplot->SetFillColor('orange');
		$bplot->SetShadow();
		 
		// Add the bar to the graph
		$graph->Add($bplot);
		 
		// .. and stroke the graph
		$graph->Stroke();

		
		//crear imagen
		$graph->Stroke(_IMG_HANDLER);

		$fileName = "graficoRankingReproduccionesPlaylist.png";
		$graph->img->Stream($fileName);

		// Mandarlo al navegador
		$graph->img->Headers();
		$graph->img->Stream();
	}
	$db->desconectar();
	
	
	
	
?>