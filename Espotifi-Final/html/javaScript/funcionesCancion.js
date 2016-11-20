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

	function validaForm(nombre) {
		if (document.getElementById('album').value.length > 0 &&	document.getElementById('artista').value.length > 0)
		{
			document.getElementById('submit').disabled = false;
		} else document.getElementById('submit').disabled = true;
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
	
	function validaNombre(patron) {
		if (document.getElementById(''+patron).value.length > 0)
		{
			return true;
		} else return false;
	}	
	
	
	function cambiarNombre(idCancion){
		if (validaNombre('nombreNuevo') == true){
			var nuevo = document.getElementById('nombreNuevo').value;
			var strURL="./funcionesCancion.php?funcion=cambiarNombre&nombreNuevo="+nuevo+"&idCancion="+idCancion;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('nombre').innerHTML = req.responseText ;
							document.getElementById('nombreNuevo').innerHTML = req.responseText ;
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
	
	function cambiarAlbum(idCancion){
		if (validaNombre('albumNuevo') == true){
			var nuevo = document.getElementById('albumNuevo').value;
			var strURL="./funcionesCancion.php?funcion=cambiarAlbum&albumNuevo="+nuevo+"&idCancion="+idCancion;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('album').innerHTML = req.responseText;
							document.getElementById('albumNuevo').innerHTML = req.responseText;
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
	
	function cambiarArtista(idCancion){
		if (validaNombre('artistaNuevo') == true){
			var nuevo = document.getElementById('artistaNuevo').value;
			var strURL="./funcionesCancion.php?funcion=cambiarArtista&artistaNuevo="+nuevo+"&idCancion="+idCancion;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							document.getElementById('artista').innerHTML = req.responseText;
							document.getElementById('artistaNuevo').innerHTML = req.responseText;
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
	
	function cambiarGenero(idCancion){
		var nuevo = document.getElementById('generoNuevo').value;
		var strURL="./funcionesCancion.php?funcion=cambiarGenero&generoNuevo="+nuevo+"&idCancion="+idCancion;
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
	
	