<h1>Gestion des matchs</h1>


<table class="table table-condensed">
	<?php foreach($sports as $s)
		if ($s->ts_type != 'Individuel')
			echo '
			<tr>
				<td><span class="flaticon flaticon-'.url_title($s->sport_nom).'"></span> '.$s->sport_nom.'</td>
				<td><a href="'.site_url('/admin/matchs/ajouter/'.$s->sport_id.'/'.url_title($s->sport_nom)).'">Ajouter</a></td>
				<td><a href="'.site_url('/admin/matchs/modifier/'.$s->sport_id.'/'.url_title($s->sport_nom)).'">Corriger</a></td>
			</tr>';
	?>
</table>