<?php 

if ($infos->sport_typeRank == 0)
	echo '<h1>'.$infos->sport_nom.' <small>Classement par écoles</small></h1>';
else
	echo '<h1>'.$infos->sport_nom.' <small>Classement par équipes</small></h1>';

echo '<form method="POST" action="">
<div class="form-group">
	<label for="showclass">Affichages liés à ce sport</label><br />
	<div class="btn-group" data-toggle="buttons">
	  <label class="btn btn-default '.( ($infos->sport_showRank) ? 'active' : '' ).'">
	    <input type="radio" name="showclass" id="showclass1" value="1" '.( ($infos->sport_showRank) ? 'checked' : '' ).'> Classement public
	  </label>
	  <label class="btn btn-default '.( (!$infos->sport_showRank) ? 'active' : '' ).'">
	    <input type="radio" name="showclass" id="showclass2" value="0" '.( (!$infos->sport_showRank) ? 'checked' : '' ).'> Classement privé
	  </label>
	</div>

	<div class="btn-group" data-toggle="buttons">
	  <label class="btn btn-default '.( ($infos->sport_showRes) ? 'active' : '' ).'">
	    <input type="radio" name="showres" id="showres1" value="1" '.( ($infos->sport_showRes) ? 'checked' : '' ).'> Matchs visibles
	  </label>
	  <label class="btn btn-default '.( (!$infos->sport_showRes) ? 'active' : '' ).'">
	    <input type="radio" name="showres" id="showres2" value="0" '.( (!$infos->sport_showRes) ? 'checked' : '' ).'> Matchs cachés
	  </label>
	</div>

	<input type="hidden" name="changeshow" value="1" />

	<input type="submit" value="Valider" class="btn btn-warning btn-lg" />	
</div>
</form>';
?>

<h2>Podium</h2>

<p class="well">Une école/équipe classée <strong>0</strong> n'apparaîtra pas dans le classement.</p>

<form method="POST" action="">
<input type="hidden" name="sended" value="1" />
<table class="table table-condensed">
<?php
	if ($infos->sport_typeRank == 0) // classement par école
	{
		foreach ($ecoles as $e)
		{
			echo '<tr>
				<td><input type="number" name="classement['.$e->p_id.']" class="form-control" value="'.$e->p_classement.'" /></td>
				<td class="'.url_title($e->ecole_nom).'">
				'.$e->ecole_nom.'</td>
			</tr>';
		}
	}
	else // classement par équipe
	{
		foreach ($equipes as $e)
		{
			echo '<tr>
				<td><input type="number" name="classement['.$e->equipe_id.']" class="form-control" value="'.$e->equipe_classement.'" /></td>
				<td class="'.url_title($e->ecole_nom).'">
				'.$e->equipe_nom.' ['.$e->ecole_nom.']</td>
			</tr>';
		}
	}
?>
</table>

<input type="hidden" name="typeRank" value="<?php echo $infos->sport_typeRank; ?>" />

<p class="text-center">
	<input type="submit" value="Confirmer les modifications" class="btn btn-success btn-lg" />	
</p>

</form>
