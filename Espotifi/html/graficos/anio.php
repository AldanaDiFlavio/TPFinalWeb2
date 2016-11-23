<?php
	include_once ("../../clases/db.php");
	include_once ("../../jpgraph-4.0.1//src/jpgraph.php"); 
	include_once ("../../jpgraph-4.0.1/src/jpgraph_bar.php");
	
	$db = new BaseDatos();
	
	if($db->conectar()){
		
		$desdeR = $_REQUEST['desde']; //tipo String
		$hastaR = $_REQUEST['hasta'];

		$desdeS = strtotime($desdeR); //tipo int (segundos desde 1970)
		$hastaS = strtotime($hastaR);
		
		$desdeD = date("m-Y", $desdeS); //tipo string (ej "01-2013")
		$hastaD = date("m-Y", $hastaS);
		
		
		
		$fechainicial = date_create($desdeR); //tipo Obj.
		$fechafinal = date_create($hastaR);
		$diferencia = $fechainicial->diff($fechafinal);
		$cantMeses = ( $diferencia->y * 12 ) + $diferencia->m;
		
		
		$varAnoActual = date("Y", strtotime($desdeR)); //tipo string
		$varMesActual = date("m", strtotime($desdeR));	

		$varAnoLimite = date("Y", strtotime($hastaR)); 
		$varMesLimite = date("m", strtotime($hastaR));				
		 
		$anoActual = (int)$varAnoActual; 
		$mesActual = (int)$varMesActual; 
		
		$anoLimite = (int)$varAnoLimite; 
		$mesLimite = (int)$varMesLimite; 
		
		
		
		$i = 0;
		$cantMeses++;
		$data = array();
		$fecha = array();
		
		while ($i < $cantMeses){

			$consulta = "SELECT count(*) cp FROM playlist WHERE EXTRACT(month FROM fecha_creacion) = $mesActual and EXTRACT(year FROM fecha_creacion) = $anoActual;";
			$resultado = mysqli_query( $db->conexion, $consulta) or die("error.");	
			$consulta = mysqli_fetch_assoc($resultado);
			
			$data[$i] = (int)$consulta['cp'];
			$fecha[$i] = "". $mesActual ."-". $anoActual ."";
			$mesActual++;
			if ($mesActual > 12){
				$anoActual++;
				$mesActual=1;
			}
			
			$i++;
			
		}
		
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
		$graph->title->Set('Cantidad de Playlist por mes.');
		
		 
		// Setup X-axis
		$graph->xaxis->SetTickLabels($fecha);
		
		 
		
		 
		// Label align for X-axis
		$graph->xaxis->SetLabelAlign('right','center');
		 
		// Add some grace to y-axis so the bars doesn't go
		// all the way to the end of the plot area
		$graph->yaxis->scale->SetGrace(20);
		 
		
		 
		// Now create a bar pot
		$bplot = new BarPlot($data);
		$bplot->SetFillColor('orange');
		$bplot->SetShadow();
		 
		// Add the bar to the graph
		$graph->Add($bplot);
		 
		// .. and stroke the graph
		$graph->Stroke();
	
		//crear imagen
		$graph->Stroke(_IMG_HANDLER);

		$fileName = "anio.png";
		$graph->img->Stream($fileName);

		// Mandarlo al navegador
		$graph->img->Headers();
		$graph->img->Stream();
			
	}
	$db->desconectar();
	
	 
	
		
	
?>