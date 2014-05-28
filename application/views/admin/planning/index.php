<h1>Gestion du planning</h1>

<h2>Ajout</h2>
<form method="POST" action="">
	
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Créer un évènement</h3>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label for="type1">Type d'évènement</label><br />
				<div class="btn-group" data-toggle="buttons">
				  <label class="btn btn-default" onclick="$('#sp').show();$('#anim').hide();">
				    <input type="radio" name="type" id="type1" value="sport"> Évènement sportif
				  </label>
				  <label class="btn btn-default active" onclick="$('#anim').show();$('#sp').hide();">
				    <input type="radio" name="type" id="type2" value="animation" checked> Animation
				  </label>
				</div>
			</div>

			<div class="form-group" id="sp" style="display:none">
				<label for="sport">Sport</label>
				<select name="sport" id="sport" class="form-control">
				<?php
					foreach ($sports as $s)
						echo '<option value="'.$s->sport_id.'">'.$s->sport_nom.'</option>';
				?>
				</select>
			</div>

			<div id="anim">
				<div class="form-group">
					<label for="animation">Animation</label>
					<input type="text" name="animation" id="animation" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label for="lieu">Lieu</label>
				<select name="lieu" id="lieu" class="form-control">
				<?php
					foreach ($lieux as $l)
						echo '<option value="'.$l->lieu_id.'">'.$l->lieu_nom.'</option>';
				?>
				</select>
			</div>

			<div class="form-group">
				<label for="jour">Jour</label>
				<select name="jour" id="jour" class="form-control">
				<?php
					foreach ($jours as $k => $v)
						echo '<option value="'.$k.'">'.$v.'</option>';
				?>
				</select>
			</div>

			<div class="form-group">
				<label for="horaire">Horaire</label>
				<input type="text" name="horaire" id="horaire" placeholder="Horaire HH:MM" pattern="[0-9]{1,2}:[0-9]{2}" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="duree">Durée</label>
				<input type="text" name="duree" id="duree" placeholder="Durée HH:MM" pattern="[0-9]{1,2}(:[0-9]{2})?" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="desc">Description <small>(2-3 lignes maximum)</small></label>
				<textarea name="desc" id="desc" class="form-control"></textarea>
			</div>

			<div class="text-center">
				<button type="submit" name="add" value="add" class="btn btn-success btn-lg">Créer cet évènement</button>
			</div>

		</div>
	</div>
</form>

<h2>Modification</h2>
<?php
foreach ($evts as $evt)
{
	$quand = (mysql_to_unix($evt->horaire)+($evt->duree*60*60) < time()) ? 'panel-info' : 'panel-success';

	echo '
	<div class="col-md-4">
	<form method="POST" action="" role="form" class="panel '.$quand.'">
	<div class="panel-heading">
		<a href="#evt'.$evt->type.$evt->id.'" onclick="$(\'.evt\').hide();$(\'#evt'.$evt->type.$evt->id.'\').toggle();"><h3 class="panel-title">
			<span class="pull-right">
				<span class="glyphicon glyphicon-chevron-down"></span>
			</span>
			<span class="flaticon flaticon-'.( ($evt->type != 'animation') ? url_title($evt->nom) : $evt->type).'"></span> '.$evt->nom.'
		</h3></a>
	</div>
	<div class="panel-body evt evt'.$evt->type.' evt'.$evt->type.'" id="evt'.$evt->type.$evt->id.'" style="display:none;">';


	if ($evt->type == 'sport')
	{
		echo '
			<div class="form-group">
				<label for="sport">Sport</label>
				<select name="sport" id="sport" class="form-control">';
					foreach ($sports as $s)
						echo '<option value="'.$s->sport_id.'" '.(($s->sport_nom == $evt->nom) ? 'selected' : '').'>'.$s->sport_nom.'</option>';

				echo '</select>
			</div>';
	}
	else
	{
		echo '
			<div class="form-group">
				<label for="animation">Animation</label>
				<input type="text" name="animation" id="animation" class="form-control" value="'.$evt->nom.'" />
			</div>';
	}



		echo '
			<div class="form-group">
				<label for="lieu">Lieu</label>
				<select name="lieu" id="lieu" class="form-control">';
				foreach ($lieux as $l)
						echo '<option value="'.$l->lieu_id.'" '.(($l->lieu_id == $evt->lieu_id) ? 'selected' : '').'>'.$l->lieu_nom.'</option>';

			echo '</select>
			</div>

			<div class="form-group">
				<label for="jour">Jour</label>
				<select name="jour" id="jour" class="form-control">';

			$split = explode(' ', $evt->horaire);

					foreach ($jours as $k => $v)
						echo '<option value="'.$k.'" '.(($k == $split[0]) ? 'selected' : '').'>'.$v.'</option>';
				echo '
				</select>
			</div>

			<div class="form-group">
				<label for="horaire">Horaire</label>
				<input type="text" name="horaire" id="horaire" placeholder="Horaire HH:MM" pattern="[0-9]{1,2}:[0-9]{2}(:[0-9]{2})?" class="form-control" value="'.$split[1].'" required />
			</div>

			<div class="form-group">
				<label for="duree">Durée</label>
				<input type="text" name="duree" id="duree" placeholder="Durée HH:MM" pattern="[0-9]{1,2}(:[0-9]{2}){0,2}" class="form-control" value="'.$evt->duree.'" required />
			</div>

			<div class="form-group">
				<label for="desc">Description <small>(2-3 lignes maximum)</small></label>
				<textarea name="desc" id="desc" class="form-control">'.$evt->description.'</textarea>
			</div>


		<input type="hidden" name="type" value="'.$evt->type.'" />
		<input type="hidden" name="id" value="'.$evt->id.'" />

		<div class="text-center">
			<input type="submit" class="btn btn-success" name="edit" value="Modifier" />
			<input type="submit" class="btn btn-danger" name="del" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet évènement ?\');" />
		</div>
	</div>
	</form>
	</div>';
}
?>