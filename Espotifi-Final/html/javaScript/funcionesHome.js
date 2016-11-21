	function getXMLHTTP() {
		var xmlhttp=false;
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{
			try{
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){	
				try{
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
	
	function habilitaFiltros(){	
		if (document.getElementById('filtrosPlaylist').style.display == 'none'){ 
			document.getElementById('filtrosPlaylist').style.display = 'block' 
		} else { document.getElementById('filtrosPlaylist').style.display = 'none' }
		realizarBusqueda();
	}
		
	function realizarBusqueda(textoBuscado, idUsuario){
		
		var filtroUsuario = document.getElementsByName('filtroPrimario')[0];
		var filtroPlaylist = document.getElementsByName('filtroPrimario')[1];
		var filtroSecundarioPlaylist = document.getElementById('filtrosPlaylist').value;
			
		if (filtroUsuario.checked == true) {
			//document.getElementById('todasMisPlaylist').innerHTML = "usuario";
			var strURL="./funcionesHome.php?funcion=realizarBusqueda&idUsuario="+idUsuario+"&filtroPrimario="+filtroUsuario.value+"&filtroSecundario='nada'&textoBuscado="+textoBuscado;
		}
		if (filtroPlaylist.checked == true && filtroSecundarioPlaylist == 'nombre') {
			//document.getElementById('todasMisPlaylist').innerHTML = "playlist - nombre";
			var strURL="./funcionesHome.php?funcion=realizarBusqueda&idUsuario="+idUsuario+"&filtroPrimario="+filtroPlaylist.value+"&filtroSecundario="+filtroSecundarioPlaylist+"&textoBuscado="+textoBuscado;
		}
		if (filtroPlaylist.checked == true && filtroSecundarioPlaylist == 'genero') {
			//document.getElementById('todasMisPlaylist').innerHTML = "playlist - genero";
			var strURL="./funcionesHome.php?funcion=realizarBusqueda&idUsuario="+idUsuario+"&filtroPrimario="+filtroPlaylist.value+"&filtroSecundario="+filtroSecundarioPlaylist+"&textoBuscado="+textoBuscado;
		}
		if (filtroPlaylist.checked == true && filtroSecundarioPlaylist == 'creador') {
			//document.getElementById('todasMisPlaylist').innerHTML = "playlist - creador";
			var strURL="./funcionesHome.php?funcion=realizarBusqueda&idUsuario="+idUsuario+"&filtroPrimario="+filtroPlaylist.value+"&filtroSecundario="+filtroSecundarioPlaylist+"&textoBuscado="+textoBuscado;
		}
		var req = getXMLHTTP();
		
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						
						document.getElementById('busquedas').innerHTML = req.responseText ;
						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}						
	}
	

	
	function seguir(idJefe, idSeguidor){
		
		if ($('#seguir').hasClass('glyphicon glyphicon-star')){
			var strURL="./funcionesHome.php?funcion=seguir&valorSeguir=0&idJefe="+idJefe+"&idSeguidor="+idSeguidor;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							$('#seguir').removeClass('glyphicon glyphicon-star').addClass('glyphicon glyphicon-star-empty');
							
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		} else if ($('#seguir').hasClass('glyphicon glyphicon-star-empty')) {
			var strURL="./funcionesHome.php?funcion=seguir&valorSeguir=1&idJefe="+idJefe+"&idSeguidor="+idSeguidor;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							$('#seguir').removeClass('glyphicon glyphicon-star-empty').addClass('glyphicon glyphicon-star');
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
	}
	
	function editarElemento(elemento,elementok) { 
		if (elemento.style.display=='none' && elementok.style.display=='none') {
			elemento.style.display='block';
			elementok.style.display='block';
		} else {
			elemento.style.display='none';
			elementok.style.display='none';
		}
	} 
	
	function enviarDenuncia(motivo, denunciado){
			
			var strURL = "./funcionesHome.php?funcion=denunciar&motivo="+motivo.value+"&denunciado="+denunciado;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							alert("" + req.responseText);;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		}
		
	
		