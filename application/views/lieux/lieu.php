<h1 onclick="initialize()"><?php echo $lieu->lieu_nom; ?> <small>Lieu</small></h1>

<div class="lieux">

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUROWNAPIKEY&sensor=true"></script>
<script type="text/javascript">
  function initialize() {
	var mapOptions = {
	  center: new google.maps.LatLng(<?php echo $lieu->lieu_lat; ?>, <?php echo $lieu->lieu_lg; ?>),
	  zoom: 19
	};
	var previousIW = undefined;
	var zoneMarqueurs = new google.maps.LatLngBounds();
	var map = new google.maps.Map(document.getElementById("map-canvas"),
		mapOptions);
	var image = 'assets/design/default/images/villag.png';
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

		//map.fitBounds(zoneMarqueurs);
	}

	<?php

		if($lieu->lieu_nom != "Village")
			echo 'addInfoWindow('.$lieu->lieu_lat.', '.$lieu->lieu_lg.', "'.$lieu->lieu_nom.'", "'.$lieu->lieu_adresse.'", "'.$lieu->lieu_gmap.'");'."\n";
		else
			echo 'addInfoWindow('.$lieu->lieu_lat.', '.$lieu->lieu_lg.', "'.$lieu->lieu_nom.'", "'.$lieu->lieu_adresse.'", "'.$lieu->lieu_gmap.'", image);'."\n";
	?>

  }
  google.maps.event.addDomListener(window, 'load', initialize);


</script>


<div id="map-canvas" style="width:100%; min-height: 90vh;"></div>

</div>

<p>
	<strong>Détails :</strong><br />
	<?php echo nl2br($lieu->lieu_adresse); ?>
</p>