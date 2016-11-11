<!DOCTYPE html>

<html>

	<head lang="en">
		<meta charset="UTF-8">
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		
		<script>
			function loadMap()	{
								var mapOptions = 	{
													center:new google.maps.LatLng(-34.6686986,-58.5614947),
													zoom:12,
													mapTypeId: google.maps.MapTypeId.ROADMAP
													};
								var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);
								}
			
		</script>	

	</head>	
		
	<body onload = "loadMap()">
		
		<div id = "mapa" style = "width: 500px; height: 400px;">
		</div>
		
	</body>
	
</html>