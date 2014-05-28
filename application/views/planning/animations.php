<h1>Animations</h1>

<p>Animations passées et à venir</p>

<div id="evts">
<?php
if (count($evenements) == 0)
	echo '<p>Aucune animation !</p>';
foreach ($evenements as $ev)
{
	$class = (mysql_to_unix($ev->pa_horaire) < time()) ? 'evenementPasse' : 'evenementAVenir' ;

	echo '<dl>
		<dt class="'.$class.'">'.$ev->pa_nom.'</dt>
		<dd>
			<a href="'.site_url('lieux/consult/'.$ev->lieu_id).'">'.$ev->lieu_nom.'</a>
			<br />
			Le '.sql_to_human($ev->pa_horaire, 'unix').' (durée : '.sql_to_duree($ev->pa_duree).')
		</dd>
	</dl>';
}
?>
</div>


