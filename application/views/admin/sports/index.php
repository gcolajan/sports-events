<h1>Gestion des sports</h1>

<?php echo $message; ?>

<h2>Ajout</h2>


<form method="POST" action="">
	<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Ajouter un sport</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="nom">Sport </label>
			<input type="text" name="nom" id="nom" value="" class="form-control" placeholder="Nom" />
		</div>

		<div class="form-group">
			<label for="typeev1">Type de sport</label><br />
			<div class="btn-group" data-toggle="buttons">
			<?php
			$first = true;
			foreach ($types as $t)
			{
				echo '
				  <label class="btn btn-default '.( ($first) ? 'active' : '' ).'">
				    <input type="radio" name="typeev" id="typeev1" value="'.$t->ts_id.'" '.( ($first) ? 'checked' : '' ).'> '.$t->ts_type.'
				  </label>';
				  $first = false;
			}
			?>
			</div>
		</div>

		<div class="form-group">
			<label for="typeclass1">Type de classement</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default active">
			    <input type="radio" name="typeclass" id="typeclass1" value="ecole" checked> École
			  </label>
			  <label class="btn btn-default">
			    <input type="radio" name="typeclass" id="typeclass2" value="equipe"> Équipe
			  </label>
			</div>
		</div>

		<div class="form-group">
			<label for="showmatch1">Afficher les matchs</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default active">
			    <input type="radio" name="showmatch" id="showmatch1" value="1" checked> Oui
			  </label>
			  <label class="btn btn-default">
			    <input type="radio" name="showmatch" id="showmatch2" value="0"> Non
			  </label>
			</div>
		</div>


		<div class="form-group">
			<label for="showclass">Afficher un classement</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default">
			    <input type="radio" name="showclass" id="showclass1" value="1"> Oui
			  </label>
			  <label class="btn btn-default active">
			    <input type="radio" name="showclass" id="showclass2" value="0" checked> Non
			  </label>
			</div>
		</div>


		<div class="text-center">
			<input type="submit" class="btn btn-success btn-lg" name="add" value="Ajouter" />
		</div>
	</div>
	</div>
</form>



<h2>Modification</h2>

<?php
$i = 0;
foreach ($sports as $s)
{
	echo '
	<div class="col-md-3">
	<form method="POST" action="" role="form" class="panel panel-info">
	<div class="panel-heading">
		<a onclick="$(\'.sport\').hide();$(\'#sport'.$s->sport_id.'\').toggle();"><h3 class="panel-title">
			<span class="glyphicon glyphicon-chevron-down pull-right"></span>
			<span class="flaticon flaticon-'.url_title($s->sport_nom).'"></span> '.$s->sport_nom.'
		</h3></a>
	</div>
	<div class="panel-body sport" id="sport'.$s->sport_id.'" style="display:none;">

		<div class="form-group">
			<label for="nom">Sport</label>
			<input type="text" name="nom" id="nom" value="'.$s->sport_nom.'" class="form-control" />
		</div>

		<div class="form-group">
			<label for="typeev">Type de sport</label><br />
			<div class="btn-group" data-toggle="buttons">';
		foreach ($types as $t)
			echo '
				<label class="btn btn-default '.( ($t->ts_id == $s->sport_type) ? 'active' : '' ).'">
				<input type="radio" name="typeev" id="typeev" value="'.$t->ts_id.'" '.( ($t->ts_id == $s->sport_type) ? 'checked' : '' ).' />
				'.$t->ts_type.'
				</label>
				';
		echo '
		</div></div>

		<div class="form-group">
			<label for="typeclass1">Type de classement</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default '.( ($s->sport_typeRank == 0) ? 'active' : '' ).'">
			    <input type="radio" name="typeclass" id="typeclass1" value="ecole" '.( ($s->sport_typeRank == 0) ? 'checked' : '' ).'> École
			  </label>
			  <label class="btn btn-default '.( ($s->sport_typeRank == 1) ? 'active' : '' ).'">
			    <input type="radio" name="typeclass" id="typeclass2" value="equipe" '.( ($s->sport_typeRank == 1) ? 'checked' : '' ).'> Équipe
			  </label>
			</div>
		</div>

		<div class="form-group">
			<label for="showmatch1">Afficher les matchs</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default '.( ($s->sport_showRes) ? 'active' : '' ).'">
			    <input type="radio" name="showmatch" id="showmatch1" value="1" '.( ($s->sport_showRes) ? 'checked' : '' ).'> Oui
			  </label>
			  <label class="btn btn-default '.( (!$s->sport_showRes) ? 'active' : '' ).'">
			    <input type="radio" name="showmatch" id="showmatch2" value="0" '.( (!$s->sport_showRes) ? 'checked' : '' ).'> Non
			  </label>
			</div>
		</div>


		<div class="form-group">
			<label for="showclass">Afficher un classement</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default '.( ($s->sport_showRank) ? 'active' : '' ).'">
			    <input type="radio" name="showclass" id="showclass1" value="1" '.( ($s->sport_showRank) ? 'checked' : '' ).'> Oui
			  </label>
			  <label class="btn btn-default '.( (!$s->sport_showRank) ? 'active' : '' ).'">
			    <input type="radio" name="showclass" id="showclass2" value="0" '.( (!$s->sport_showRank) ? 'checked' : '' ).'> Non
			  </label>
			</div>
		</div>


		<input type="hidden" name="id" value="'.$s->sport_id.'" />

		<div class="text-center">
			<input type="submit" class="btn btn-success" name="edit" value="Modifier" />
			<input type="submit" class="btn btn-danger" name="del" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce sport ?\');" />
		</div>
	</div>
	</form>
	</div>';

	$i++;
}
?>