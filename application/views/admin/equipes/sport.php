<h1>Gestion des équipes de <?php echo $sport->sport_nom; ?></h1>

<?php
if (count($ecoles) == 0):
	echo '<p class="alert alert-danger">Vous devriez d\'abord inscrire quelques écoles à participer à « '.$sport->sport_nom.' »</p>';
else:
?>

<?php echo $message; ?>

<h2>Ajout</h2>
<dl class="panel panel-success">
	<dt class="panel-heading"><h3 class="panel-title">Créer une équipe ou un sportif</h3></dt>
	<dd class="panel-body">
		<form method="POST" action="">
		<div class="form-group">
		    <label for="ecole" class="control-label">École</label>
		    <div>
				<select id="ecole" name="ecole" class="form-control">
					<?php foreach ($ecoles as $e)
						echo '<option value="'.$e->ecole_id.'">'.$e->ecole_nom.'</option>';
					?>
				</select>
		    </div>
		</div>

		<div class="form-group">
		    <label for="nom" class="control-label">Nom</label>
		    <div>
				<input type="text" id="nom" name="nom" class="form-control" />
		    </div>
		</div>


		<div class="text-center">
			<input type="submit" name="add" value="Créer" class="btn btn-success btn-lg" />
		</div>
		</form>
	</dd>
</dl>

<dl class="panel panel-success">
	<dt class="panel-heading"><h3 class="panel-title"><a style="display:block" onclick="$('#panelMultiple').toggle();"><span class="glyphicon glyphicon-chevron-down pull-right"></span>Ajout multiple</a></h3></dt>
	<dd class="panel-body" id="panelMultiple" style="display:none;">
		<form enctype="multipart/form-data" method="POST" action="">

		<p class="well">L'ajout multiple s'appuie sur un fichier <strong>CSV</strong>, une personne est identifée par <strong>deux colonnes</strong>, ne pas nommer les colonnes (débuter en A1).
		Si vous prévoyez des équipes de plusieurs personnes, placez-les sur la même ligne en prévoyant 2 colonnes par participant.<br />
		Attention, le nom de l'équipe final est limité à 255 caractères (tronqué).</p>

		<div class="form-group">
		    <label for="ecole" class="control-label">École</label>
		    <div>
				<select id="ecole" name="ecole" class="form-control">
					<?php foreach ($ecoles as $e)
						echo '<option value="'.$e->ecole_id.'">'.$e->ecole_nom.'</option>';
					?>
				</select>
		    </div>
		</div>

		<div class="form-group">
		    <label for="nb" class="control-label">Nombre de personnes par équipes</label>
			<input type="number" id="nb" name="nb" class="form-control" pattern="[0-9]{1,}" value="1" />
		</div>

		<div class="form-group">
		    <label for="fichier" class="control-label">Fichier CSV (max. 1 Mo)</label>
		    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
			<input type="file" id="fichier" name="fichier" class="form-control" />
		</div>


		<div class="text-center">
			<input type="submit" name="multiple" value="Importer" class="btn btn-success btn-lg" />
		</div>
		</form>
	</dd>
</dl>

<h2>Modification</h2>

<table class="table table-condensed">
<tr>
	<th>École</th>
	<th>Nom équipe</th>
	<th>Validation</th>
</tr>
<?php
$ecole = 0;
foreach ($equipes as $e)
{
	/*if ($ecole != $e->ecole_id)
	{

		if ($ecole != 0)
		{
			echo '</ul></div>
			<div class="panel panel-info">';
		}

		echo '
		<div class="panel-heading">
			<a href="#ecole'.$e->ecole_id.'" style="display:block" onclick="$(\'.ecole\').hide(); $(\'#ecole'.$e->ecole_id.'\').toggle();">
				<span class="glyphicon glyphicon-chevron-down pull-right"></span>
				'.$e->ecole_nom.'
			</a>
		</div>
		<ul class="list-group panel-body ecole" id="ecole'.$e->ecole_id.'" style="display:none">';
	}

	echo '<li class="list-group-item">
		<form method="POST" action="">
		<div class="form-group">
			<input type="text" name="nom" value="'.$e->equipe_nom.'" class="form-control" />
		</div>
		<div class="form-group">
		<select id="ecole" name="ecole" class="form-control">';
		foreach ($ecoles as $ecole)
		{
			$selected =  ($ecole->ecole_id == $e->ecole_id) ? 'selected' : '';
			echo '<option '.$selected.' value="'.$ecole->ecole_id.'">'.$ecole->ecole_nom.'</option>';
		}

		echo '</select>
		</div>

		<div class="form-group text-center">
			<button type="submit" name="edit" value="'.$e->equipe_id.'" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
			<button type="submit" name="del" value="'.$e->equipe_id.'" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer « '.$e->equipe_nom.' »\');"><span class="glyphicon glyphicon-remove"></span></button>
		</div>
		</form>
		</li>';

	$ecole = $e->ecole_id;*/


	echo '
	<tr>
	<form method="POST">
		<td>
			<div class="form-group">
					<select id="ecole" name="ecole" class="form-control">';
					foreach ($ecoles as $ecole)
					{
						$selected =  ($ecole->ecole_id == $e->ecole_id) ? 'selected' : '';
						echo '<option '.$selected.' value="'.$ecole->ecole_id.'">'.$ecole->ecole_nom.'</option>';
					}

			echo '</select>
			</div>
		</td>
		<td><input type="text" name="nom" value="'.$e->equipe_nom.'" class="form-control" /></td>
		<td>
			<div class="form-group text-center">
				<button type="submit" name="edit" value="'.$e->equipe_id.'" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
				<button type="submit" name="del" value="'.$e->equipe_id.'" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer « '.$e->equipe_nom.' »\');"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</td>
	</form>
	</tr>
	';

}

?>
</table>

<?php endif; ?>