<h1>Gestion des écoles</h1>

<?php echo $message; ?>

<h2>Ajout</h2>


<form method="POST" action="">
	<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Ajouter une école</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="nom">École </label>
			<input type="text" name="nom" id="nom" value="" class="form-control" placeholder="Nom" />
		</div>

		<div class="form-group">
			<label for="couleur">Couleur</label>
			<input type="color" name="couleur" id="couleur" value="#000000" class="form-control" placeholder="Couleur #FF8800" />
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
foreach ($ecoles as $e)
{
	echo '
	<div class="col-md-3">
	<form method="POST" action="" role="form" class="panel panel-info">
	<div class="panel-heading">
		<a href="#ecole'.$e->ecole_id.'" onclick="$(\'.ecole\').hide();$(\'#ecole'.$e->ecole_id.'\').toggle();"><h3 class="panel-title">
			<span class="glyphicon glyphicon-chevron-down pull-right"></span>
			'.$e->ecole_nom.'
		</h3></a>
	</div>
	<div class="panel-body ecole" id="ecole'.$e->ecole_id.'" style="display:none;">

		<div class="form-group">
			<label for="nom">École</label>
			<input type="text" name="nom" id="nom" value="'.$e->ecole_nom.'" class="form-control" />
		</div>

		<div class="form-group">
			<label for="couleur">Couleur</label>
			<input type="color" name="couleur" id="couleur" value="'.$e->ecole_couleur.'" class="form-control" placeholder="Couleur #FF8800" />
		</div>

		<input type="hidden" name="id" value="'.$e->ecole_id.'" />

		<div class="text-center">
			<input type="submit" class="btn btn-success" name="edit" value="Modifier" />
			<input type="submit" class="btn btn-danger" name="del" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette école ?\');" />
		</div>
	</div>
	</form>
	</div>';

	$i++;
}
?>