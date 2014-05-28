<div class="sport">
<?php echo '<h4><i class="flaticon flaticon-'.url_title($sport->sport_nom).'"></i> Derniers matchs de '.$sport->sport_nom.'</h4> ';

if ($sport->sport_showRes == 0)
	echo '<p class="alert alert-warning">Les matchs ne sont pas accessibles pour cette discipline.</p>';
else if (count($matchs) == 0)
	echo '<p class="alert alert-warning">Aucun match n\'a été joué dans cette discipline.</p>';
else
	foreach ($matchs as $match)
	{
		$ecole1 = $participations[$match->eq1_participation]->ecole_nom;
		$ecole2 = $participations[$match->eq2_participation]->ecole_nom;


		echo '<div class="row list-group-item">
		     		<div class="col-xs-4 " >
			        	<h5 class="list-group-item-heading">'.$match->eq1_nom.'</h5>
				        <div class="ecole '.url_title($ecole1).'">'.$ecole1.'</div>

					</div>
					<div class="col-xs-4 centrer">
						<h5 class="list-group-item-heading">'.$match->match_res1.' <i class="flaticon flaticon-'.url_title($sport->sport_nom).' "></i> '.$match->match_res2.'</h5>
					</div>

					<div class="col-xs-4 right " >
			        	<h5 class="list-group-item-heading">'.$match->eq2_nom.'</h5>
			        	<div class="'.url_title($ecole2).' ecole ">'.$ecole2.'</div> 
				    </div>
				
		      </div>';
	}
		
	echo '<h4 class="center"><a href="'.site_url('../planning/sports/'.$sport->sport_id.'/'.url_title($sport->sport_nom)).'">Consulter les prochains matchs de '.$sport->sport_nom.'</a></h4>';


	?>
</div>


 

