<h1>Gestion des équipes <small>Choisir un sport</small></h1>

<ul class="list-group">
	<?php foreach($sports as $s)
		echo '<li class="list-group-item center"><a href="'.site_url('/admin/equipes/sport/'.$s->sport_id.'/'.url_title($s->sport_nom)).'">'.$s->sport_nom.'</a></li>';
	?>
</li>