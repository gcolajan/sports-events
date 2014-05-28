<div class="planning">

<div class=" btn-group " data-toggle="buttons">
  <label class="btn btn-primary btn-sport active" onclick="switchPlanning1('sport');">
    <input type="checkbox" checked> Sports
  </label>
  <label class="btn btn-danger btn-anim active" onclick="switchPlanning1('animation');">
    <input type="checkbox" checked> Animations
  </label>
</div>

<div class="pull-right btn-group " data-toggle="buttons">
  <label class="btn btn-default btn-passe" onclick="switchPlanning2('horaire-depasse');">
    <input type="checkbox"> Passés
  </label>
  <label class="btn btn-default  btn-venir active" onclick="switchPlanning2('horaire-avenir');">
    <input type="checkbox" class="switch" checked> À venir
  </label>
</div>

<div id="nextEvts">
<?php
if (count($evenements) == 0)
	echo '<p>Aucun événement prévu !</p>';
foreach ($evenements as $ev)
{
	$quand = (mysql_to_unix($ev->horaire)+($ev->duree*60*60) < time()) ? 'horaire-depasse' : 'horaire-avenir';
	$type = $ev->type; // "sport" ou "animation"
	/* flaticon -> si ev = sport -> cherche flaticon ecran correspondant*/
	/* a voir si icones pour def ev par defauts (animation / soirée etc. */
	if($type=="sport"){$type = $ev->nom;}

	echo '
	<dl class="'.$quand.' '.$ev->type.'">
	<div class="panel panel-default">
	 	<div class="panel-heading col-xs-12">
 			<dt>
 			<div class="col-xs-9 no-padding" >
 			<span class="flaticon flaticon-'.url_title($type).'"></span>
			'.$ev->nom.'
			</div>
			<div class="col-xs-3 no-padding right" >
				
				<i class="flaticon flaticon-location"></i>&nbsp;<a href="'.site_url('lieux/consult/'.$ev->lieu_id).'">'.$ev->lieu_nom.'</a>
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
	</dl>';
}
?>
</div>
</div>