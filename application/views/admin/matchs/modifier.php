<h1><span class="flaticon flaticon-<?php echo url_title($sport->sport_nom); ?>"></span> Scores de <?php echo $sport->sport_nom ?> <small>Modifier</small></h1>

<?php
if (count($matchs) == 0)
	echo '<p class="alert alert-warning">Aucun match n\'a été joué dans cette discipline.</p>';
else
	foreach ($matchs as $match)
	{
		echo '
<div class="col-md-4">
<div class="panel panel-info">
	<div class="panel-heading">
		Match #'.$match->match_id.'
	</div>
	<div class="panel-body">
		<form method="POST" action="">

			<div class="form-group">
				<label for="res1_'.$match->match_id.'"><small>['.$participations[$match->eq1_participation]->ecole_nom.']</small> '.$match->eq1_nom.'</label>
				<input type="text" name="res1" id="res1_'.$match->match_id.'" value="'.$match->match_res1.'" class="form-control" />
			</div>

			<div class="form-group">
				<label for="res2_'.$match->match_id.'"><small>['.$participations[$match->eq2_participation]->ecole_nom.']</small> '.$match->eq2_nom.'</label>
				<input type="text" name="res2" id="res2_'.$match->match_id.'" value="'.$match->match_res2.'" class="form-control" />
			</div>

			<input type="hidden" name="id" value="'.$match->match_id.'" />

			<div class="text-center">
				<input type="submit" name="edit" value="Modifier" class="btn btn-success" />
				<input type="submit" name="del" value="Supprimer" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce match ?\');" />
			</div>
		</form>
	</div>
</div>
</div>';
	}

?>