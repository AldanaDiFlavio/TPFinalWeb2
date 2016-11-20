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

	function reproduceCancion(canciones, idPlaylist, contador_reproducciones) {
		var strURL="./reproduceCancion.php?funcion=reproduceCancion&canciones="+canciones+"&idPlaylist="+idPlaylist;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('audio').innerHTML =req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
			req.open("GET", strURL, true);
				req.send(null);
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
	
	function validarNombre(texto){
		if (texto.length < 1){
			document.getElementById('nombreNuevoOk').disabled = true;
		}
	}
		
	function cambiarNombre(idPlaylist){
		if (validaNombre() == true){
			var nuevo = document.getElementById('nombreNuevo').value;
			var strURL="./funcionesMiPlaylist.php?funcion=cambiarNombre&nombreNuevo="+nuevo+"&idPlaylist="+idPlaylist;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('nombre').innerHTML = req.responseText ;
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
			document.getElementById('nombreNuevo').value = "";
		}
	}
		
	function cambiarGenero(idPlaylist){
		var nuevo = document.getElementById('generoNuevo').value;
		var strURL="./funcionesMiPlaylist.php?funcion=cambiarGenero&generoNuevo="+nuevo+"&idPlaylist="+idPlaylist;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('genero').innerHTML = req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}
	}
		
	function cambiarEstado(idPlaylist){
		var nuevo = document.getElementById('estadoNuevo').value;
		var strURL="./funcionesMiPlaylist.php?funcion=cambiarEstado&estadoNuevo="+nuevo+"&idPlaylist="+idPlaylist;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('estado').innerHTML = req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}
	}
	
	function cambiarEsquema(idPlaylist){
		var nuevoFondo = document.getElementById('nuevoColorFondo').value;
		var nuevoLetras = document.getElementById('nuevoColorLetras').value;
		
		var patron="#";
			nuevoFondo = nuevoFondo.replace(patron,'');
		nuevoLetras = nuevoLetras.replace(patron,'');
			var strURL="./funcionesMiPlaylist.php?funcion=cambiarEsquema&nuevoFondo="+nuevoFondo+"&nuevoLetras="+nuevoLetras+"&idPlaylist="+idPlaylist;
		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementsByTagName('body')[0].style = req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}
	}
	
	function eliminaCancion(idCancion, idPlaylist){
		var strURL="./funcionesMiPlaylist.php?funcion=eliminaCancion&idCancion="+idCancion+"&idPlaylist="+idPlaylist;
		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('tablaListadoCanciones').innerHTML = req.responseText ;
						listarTodasCanciones(idPlaylist);
						validaCreacionPlaylist();
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}
	}
	
	function listarTodasCanciones(idPlaylist){
			var strURL="./funcionesMiPlaylist.php?funcion=listarTodasCanciones&idPlaylist="+idPlaylist;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('tablaListadoCancionesDisponibles').innerHTML = req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}	
	}
	
	function agregarCancionNuevaAPlaylist(idCancionNueva, idPlaylist){
		
		var strURL="./funcionesMiPlaylist.php?funcion=agregarCancionNuevaAPlaylist&idCancionNueva="+idCancionNueva+"&idPlaylist="+idPlaylist;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('tablaListadoCanciones').innerHTML = req.responseText ;
						listarTodasCanciones(idPlaylist);
						validaCreacionPlaylist();
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
				req.open("GET", strURL, true);
				req.send(null);
		}
	}
	
	function mostrarTodasLasCanciones(idPlaylist){
		if (tablaListadoCancionesDisponibles.style.display=='none'){
			tablaListadoCancionesDisponibles.style.display='block';
			
		} else {
			tablaListadoCancionesDisponibles.style.display='none';
			
		}
		listarTodasCanciones(idPlaylist);
	}
	
	function validaCreacionPlaylist(){
		var cancionesCero = document.getElementById("tablaListadoCanciones").rows.length;
		if (cancionesCero > 1){
			document.getElementById('volver').disabled = false;
		} else document.getElementById('volver').disabled = true;
		
	}
	
	function sumarVoto(idPlaylist, idUsuario){
		if ($('#voto').hasClass('glyphicon glyphicon-collapse-up')){
			var strURL="./funcionesMiPlaylist.php?funcion=votar&valorVoto=0&idPlaylist="+idPlaylist+"&idUsuario="+idUsuario;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							$('#voto').removeClass('glyphicon glyphicon-collapse-up').addClass('glyphicon glyphicon-unchecked');
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		} else if ($('#voto').hasClass('glyphicon glyphicon-unchecked')) {
			var strURL="./funcionesMiPlaylist.php?funcion=votar&valorVoto=1&idPlaylist="+idPlaylist+"&idUsuario="+idUsuario;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							$('#voto').removeClass('glyphicon glyphicon-unchecked').addClass('glyphicon glyphicon-collapse-up');
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
	
	function validaCreacion(){
		var nombre = document.formCrearPlaylist.nombre.value;
			
		if(nombre.length > 0){ 
			document.formCrearPlaylist.accion.disabled = false;
		}
		else { 
			document.formCrearPlaylist.accion.disabled = true;
		}
	}
	
	function validaNombre() {
		if (document.getElementById('nombreNuevo').value.length > 0)
		{
			return true;
		} else return false;
	}	
	
	
	