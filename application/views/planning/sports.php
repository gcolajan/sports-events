<div id="evts">

<?php
echo '<h3 class="center">Prochains matchs de '.$sport->sport_nom.'</h3>';


$found = false;


foreach ($evenements as $ev)
{
	//on affiche les evenements sportifs selectionnés 
	if(stripos($ev->nom,$sport->sport_nom) !== false){
		$found = true;
		echo '
			<div class="panel panel-default">
			 	<div class="panel-heading col-xs-12">
			 		<dt>
			 		<div class="col-xs-9 no-padding" >
		 				<span class="flaticon flaticon-'.url_title($ev->nom).'"></span>
						'.$ev->nom.'
					</div>
					<div class="col-xs-3 no-padding right" >
						<i class="flaticon flaticon-location"></i>
						<a href="'.site_url('lieux/consult/'.$ev->lieu_id).'">'.$ev->lieu_nom.'</a>
					</div>
					</dt>
				</div>
		

				<div class="panel-body">
					<dd>
						'.$ev->description.'
					</dd>
				</div>

				<div class="panel-footer">
					<dd>
					'.ucfirst(short_date($ev->horaire)).' (durée : '.sql_to_duree($ev->duree).')
					</dd>
				</div>
			</div>
			';
	}
}

if(! $found)
	echo '<p class="alert alert-warning">Plus aucun match de '.$sport->sport_nom.' !</p>';
?>

<?php
echo '<h4 class="center"><a href="'.site_url('planning').'">Retour au planning</a></h4>';

?>
</div>