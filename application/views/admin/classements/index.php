<h1>Classements</h1>

<table class="table table-condensed">
	<?php foreach($sports as $s)
		echo '
		<tr>
			<td><a href="'.site_url('/admin/classements/sport/'.$s->sport_id.'/'.url_title($s->sport_nom)).'"><span class="flaticon flaticon-'.url_title($s->sport_nom).'"></span> '.$s->sport_nom.'</a></td>
		</tr>';
	?>
</table>