<?php
foreach ($nouvelles as $nv)
	echo '<div class="well center">'.(nl2br($nv->news_contenu)).'</div>';
?>


<div id="currentEvts" class="well padding-lr">
	<?php
	if (count($evenements) == 0){
		echo '<h3 class="center">Aucun événement n\'a lieu en ce moment !</h3>';
	}else{
		echo '<h3 class="center">Évenements en ce moment !</h3>';
	}

	foreach ($evenements as $ev)
	{
	$type = $ev->type; // "sport" ou "animation"
	if($type=="sport"){$type = $ev->nom;}
		echo '
			<div class="panel panel-default">
			 	<div class="panel-heading">
			 		<dt>
		 			<span class="flaticon flaticon-'.url_title($type).'"></span>
					'.$ev->nom.'
					</dt>
				</div>
				<div class="panel-body">
					<dd>
						'.$ev->description.'
					</dd>
				</div>
				<div class="panel-footer">
					<dd>
					<i class="flaticon flaticon-location"></i><a href="'.site_url('lieux/consult/'.$ev->lieu_id).'">&nbsp;'.$ev->lieu_nom.'</a>
					</dd>
				</div>
			</div>
			';
	}
	?>
</div>