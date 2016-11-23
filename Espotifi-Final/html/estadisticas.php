
<html>
  	<head>
	    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script src="http://code.jquery.com/jquery-latest.js"></script>
	    <script type="text/javascript">
    
	    $(function(){
	    	google.charts.load('current', {'packages':['corechart','table']});

	      	google.charts.setOnLoadCallback(loadData);
	    });
      	//PROBLEMAS CON ESTA FUNCION!!!! NO MUESTRA EL GRAFICO HAY PROBLEMAS CON EL JSON AIUDAA!!!!! BORRAR ESTO XD
      	function loadData2() {
      		//periodo
      		var ini = document.getElementById('fechaIni');
      		var fin = document.getElementById('fechaFin');

      		$.ajax({
      			type: "GET",
	      		url:"../php/cantPlaylistPeriodo.php",
	      		data:{id=fechaIni&id=fechaFin;},
	      		dataType:"JSON",
	      		success: drawChartPlaylistPeriodo
	      	});
      	}

      	function loadData() {
      		//periodo
      		$.ajax({
	      		url:"../php/cantPlaylistPeriodo.php",
	      		dataType:"JSON",
	      		success: drawChartPlaylistPeriodo
	      	});
      		//reproducciones
	      	$.ajax({
	      		url:"../php/rankingCantReproducciones.php",
	      		dataType:"JSON",
	      		success: drawChartCantReproducciones
	      	});
	      	//votos
	      	$.ajax({
	      		url:"../php/rankingCantPlaylistVotos.php",
	      		dataType:"JSON",
	      		success: drawChartCantVotos
	      	});
	      	//bann
	        $.ajax({
	      		url:"../php/cantUsuariosBanneados.php",
	      		dataType:"JSON",
	      		success: drawChartCantUsuariosBann
	      	});
	        //pais
	      	$.ajax({
	      		url:"../php/cantUsuariosPais.php",
	      		dataType:"JSON",
	      		success: drawChartCantUsuariosPais
	      	});
      	}


      	
      	//periodo
      	function drawChartPlaylistPeriodo(jsonData){
	      	var pieData = new google.visualization.arrayToDataTable(jsonData);
	      	var chart = new google.visualization.PieChart(document.getElementById('cantPlaylistPeriodoChart'));
	      	chart.draw(pieData,{title: '', width:500, height:300});
	      	var table = new google.visualization.Table(document.getElementById('cantPlaylistPeriodoTable'));
	      	table.draw(pieData,{showRowNumber: true, width: '60%'});
      	}

      //reproducciones
      	function drawChartCantReproducciones(jsonData){
	      	var pieData = new google.visualization.arrayToDataTable(jsonData);
	      	var chart = new google.visualization.PieChart(document.getElementById('rankingCantReproduccionesChart'));
	      	chart.draw(pieData,{title: '', width:500, height:300});
	      	var table = new google.visualization.Table(document.getElementById('rankingCantReproduccionesTable'));
	      	table.draw(pieData,{showRowNumber: true, width: '60%'});
      	}

      //votos
      	function drawChartCantVotos(jsonData){
	      	var pieData = new google.visualization.arrayToDataTable(jsonData);
	      	var chart = new google.visualization.PieChart(document.getElementById('rankingCantPlaylistVotosChart'));
	      	chart.draw(pieData,{title: '', width:500, height:300});
	      	var table = new google.visualization.Table(document.getElementById('rankingCantPlaylistVotosTable'));
	      	table.draw(pieData,{showRowNumber: true, width: '60%'});
      	}
		//bann
      	function drawChartCantUsuariosBann(jsonData){
	      	var pieData = new google.visualization.arrayToDataTable(jsonData);
	      	var chart = new google.visualization.PieChart(document.getElementById('cantUsuariosBanneadosChart'));
	      	chart.draw(pieData,{title: '', width:500, height:300});
	      	var table = new google.visualization.Table(document.getElementById('cantUsuariosBanneadosTable'));
	      	table.draw(pieData,{showRowNumber: true, width: '60%'});
      	}
      	//pais
      	function drawChartCantUsuariosPais(jsonData){
	      	var pieData = new google.visualization.arrayToDataTable(jsonData);
	      	var chart = new google.visualization.PieChart(document.getElementById('cantUsuariosPaisChart'));
	      	chart.draw(pieData,{title: '', width:500, height:300});
	      	var table = new google.visualization.Table(document.getElementById('cantUsuariosPaisTable'));
	      	table.draw(pieData,{showRowNumber: true, width: '60%'});
      	}
    </script>
  </head>
  	<body>
  		<h1>Estadisticas</h1>
  		
		<div>
			<h3>Cantidad de playlist creada en un periodo determinado</h3>
			<form id="form" name="form" method="get" action="../php/cantPlaylistPeriodo.php">
				Fecha Inicio:
				<input type="date" id="fechaIni" name="fechaIni">
				<br>
				Fecha Final:
				<input type="date" id="fechaFin" name="fechaFin">
				<br>
				<input type="submit" value="Consultar" onclick="loadData2();">
			</form>
  			<div id="cantPlaylistPeriodoChart" style="border: 1px solid #ccc"></div>
       		<div id="cantPlaylistPeriodoTable" style="border: 1px solid #ccc"></div>
		</div>
  		<div>
  			<h3>Ranking de playlist por cantidad de reproducciones</h3>
  			<div id="rankingCantReproduccionesChart" style="border: 1px solid #ccc"></div>
      		<div id="rankingCantReproduccionesTable" style="border: 1px solid #ccc"></div>
  		</div>
  		<div>
  			<h3>Ranking de playlist por votos</h3>
  			<div id="rankingCantPlaylistVotosChart" style="border: 1px solid #ccc"></div>
      	   	<div id="rankingCantPlaylistVotosTable" style="border: 1px solid #ccc"></div>
  		</div>
  		<div>
  			<h3>Cantidad de usuarios banneados</h3>
  			<div id="cantUsuariosBanneadosChart" style="border: 1px solid #ccc"></div>
      	   	<div id="cantUsuariosBanneadosTable" style="border: 1px solid #ccc"></div>
  		</div>
  		<div>
  			<h3>Cantidad de usuarios por pais</h3>
  			<div id="cantUsuariosPaisChart" style="border: 1px solid #ccc"></div>
      		<div id="cantUsuariosPaisTable" style="border: 1px solid #ccc"></div>
  		</div>
  	</body>
</html>
