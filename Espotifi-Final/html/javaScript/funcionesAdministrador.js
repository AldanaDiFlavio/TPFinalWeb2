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

	
	function banearPerfil(idPerfil) {
		var strURL="./funcionesAdministrador.php?funcion=banearPerfil&idPerfil="+idPerfil;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('principal').innerHTML = req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
			req.open("GET", strURL, true);
				req.send(null);
		}
	}	
	
		
	function habilitarPerfil(idPerfil) {
		var strURL="./funcionesAdministrador.php?funcion=habilitarPerfil&idPerfil="+idPerfil;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('principal').innerHTML = req.responseText ;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
			req.open("GET", strURL, true);
				req.send(null);
		}
	}

	function banearPlaylist(idPlaylist) {
		
		if ($("#"+idPlaylist+">*").hasClass('glyphicon glyphicon-eye-close')){
			
			//$('#baneo').removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
			var strURL="./funcionesAdministrador.php?funcion=banearPlaylist&idPlaylist="+idPlaylist;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							$("#"+idPlaylist+">*").removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
						} else {
							alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}
				}
					req.open("GET", strURL, true);
					req.send(null);
			}
		} else if ($("#"+idPlaylist+">*").hasClass('glyphicon glyphicon-eye-open')) {
			
			//$('#baneo').removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
			var strURL="./funcionesAdministrador.php?funcion=banearPlaylist&idPlaylist="+idPlaylist;
			var req = getXMLHTTP();
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
							$("#"+idPlaylist+">*").removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
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