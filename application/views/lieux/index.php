<h1 onclick="initialize()">Lieux</h1>

<div class="lieux">


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUROWNAPIKEY&sensor=true"></script>
<script type="text/javascript">
  function initialize() {
	var mapOptions = {
	  center: new google.maps.LatLng(48.120804, -1.63575),
	  zoom: 15
	};
	var previousIW = undefined;
	var zoneMarqueurs = new google.maps.LatLngBounds();
	var map = new google.maps.Map(document.getElementById("map-canvas"),
		mapOptions);
	var image = 'https://maps.google.com/mapfiles/kml/shapes/schools_maps.png';
	console.log(image);
	function addInfoWindow(lat, lg, nom, desc, lien, img) {
		 img = typeof img !== 'undefined' ?  img : null; /*default value*/
		var marqueur = new google.maps.Marker({
					position: new google.maps.LatLng(lat, lg),
					map: map,
					title: nom,
					icon: img
				});

		zoneMarqueurs.extend(marqueur.getPosition());

		var infoWindow = new google.maps.InfoWindow({
			content: '<p><strong>'+nom+'</strong><br /><em>'+desc+'</em><br /><a href="'+lien+'">Aller !</a></p>'
		});

		google.maps.event.addListener(marqueur, 'click', function () {
			if (previousIW) previousIW.close();
			infoWindow.open(map, marqueur);
			previousIW = infoWindow;
		});

		map.fitBounds(zoneMarqueurs);
	}

	<?php
	foreach ($lieux as $l){
		$nom = $l->lieu_nom;
		if($nom != "Village")
			echo 'addInfoWindow('.$l->lieu_lat.', '.$l->lieu_lg.', "'.$l->lieu_nom.'", "'.$l->lieu_adresse.'", "'.$l->lieu_gmap.'");'."\n";
		else
			echo 'addInfoWindow('.$l->lieu_lat.', '.$l->lieu_lg.', "'.$l->lieu_nom.'", "'.$l->lieu_adresse.'", "'.$l->lieu_gmap.'", image);'."\n";
	}
	?>
/*
if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
     addInfoWindow(position.coords.latitude,position.coords.longitude,null,null,null,image);

     });
  }
*/
  }
  google.maps.event.addDomListener(window, 'load', initialize);


</script>


<div id="map-canvas" style="width:100%; min-height: 90vh;"></div>

</div>