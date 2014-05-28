<?php 
$currentSport = 0;
$cpt=0;
$div = false;
?>

<div class="row resultats">
	<div class="col-md-12">
		<ul class="list-group">
			<?php
			foreach ($parts as $p)
			{
				if ($currentSport != $p->sport_id)
				{
					if($cpt!=0){
						//on referme les div précedentes.
						echo '</div></div>'; if($div) {echo'</div>'; $div=false;}
					}
					$cpt=1;
					/*Debut Menu*/
					echo '	
							<div class="list-group-item">
							<a class="collapse_glyphicon" data-toggle="collapse" href="#collapse'.$p->sport_id.'">
									<span class="flaticon flaticon-'.url_title($p->sport_nom).'"></span>
									<span class="toupper">'.$p->sport_nom.'</span>				
								</a>

    						</div>
							';

					/*Fin Menu*/
					//Debut du Collapse -> on ouvre deux div 
					echo '<div id="collapse'.$p->sport_id.'" class="panel-collapse collapse">
      						<div class="panel-body">
      						';
      						//On regarde si il existe des res de matchs
					if($p->sport_showRes && ($p->ts_type == "Collectif")){
					

						echo '<h4 class=" alert alert-success center">
									<a href="'.site_url('/resultats/sport/'.$p->sport_id.'/'.url_title($p->sport_nom)).'" class="alert-link">
										Voir les résultats des matchs
									</a>
								</h4>';
					}
					$currentSport = $p->sport_id;
					$firstHiding = true;
					$firstTeamRank = true;
				}
				// foreach collapse 
				// Si ce sport est affiché mais qu'aucune école ne participe
				if (empty($p->ecole_id))
					echo '<p class="alert alert-warning">Aucune école ne s\'est inscrite sur cette discipline.</p>';
				else
				{ 
					

					if ($p->sport_showRank) // Si on veut afficher le classement actuellement
							if ($p->sport_typeRank == 0) // CLASSEMENT / ECOLES
							{   
								if($firstHiding){
									echo '<div class="alert alert-default">
											<h4 class="center">	<span class="flaticon flaticon-rankings"></span>
											&nbsp;Classement final par écoles</h4>';
											$firstHiding = false;$div =true;
								}
								
								if ($p->p_classement != 0)
								{
									echo '<p>';
									$href = site_url('/resultats/hof/'.$p->p_id.'/'.url_title($p->ecole_nom).'/'.url_title($p->sport_nom));
									echo '<a class="'.url_title($p->ecole_nom).'" href="'.$href.'">'.$p->p_classement.'. '.$p->ecole_nom.'</a></p>';
								}	
							}
							else // CLASSEMENT / JOUEURS
							{
								if (!isset($cleq[$p->sport_id]))
								{
									if ($firstTeamRank)
										echo '<p class="alert alert-info">Les classements n\'ont pas encore été établi !</p>';
								}
								else
									if ($firstTeamRank)
									{	echo '
												<div class="alert alert-default"><h4 class="center"><span class="flaticon flaticon-ranking"></span>&nbsp; Classement final par joueurs</h4>';
										// On fait appel aux résultats qui ont été préselectionnés avec une requête à côté (histoire que ça soit pas TROP horrible)
										foreach ($cleq[$p->sport_id] as $score)
										{
											echo '
													<h5 class="'.url_title($score->ecole_nom).'">
														'.$score->equipe_classement.'. '.$score->equipe_nom.' <small>'.$score->ecole_nom.'</small>
													</h5>';
										}
										echo'</div>';
									}
								$firstTeamRank = false;
							}
					else //sinon on ne veut pas affichr le classement
					{
						if ($firstHiding)
						{
							echo '
							<div class="alert alert-info">Les classements n\'ont pas encore été établi !</div>';
							$firstHiding = false;


						}
					}

				}
			
			}
			?>
			</div>
		</div>
		</ul>
	</div>
</div>


