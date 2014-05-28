<h1>Gestion des lieux</h1>

<?php echo $message; ?>

<h2>Ajout</h2>


<form method="POST" action="">
	<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title"><input type="text" name="nom" id="nom" value="" class="form-control" placeholder="Nom" /></h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="adresse">Détails </label>
			<textarea name="adresse" id="adresse" class="form-control"></textarea>
		</div>

		<div class="form-group">
		<label for="gmap">Lien Google Maps</label>
		<input type="text" name="gmap" id="gmap" class="form-control" />
		</div>


		<div class="form-group">
			<label for="lat">Coordonnées GPS</label>
			<input type="text" class="form-control" name="lat" id="lat" placeholder="Latitude" />
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="lg" id="lg" placeholder="Longitude" />
		</div>
		<!--<div class="form-group">
		 <label class="btn btn-primary"><input type="checkbox" name="home" id="home"> Village</label>
		</div>	!-->

		<div class="text-center">
			<input type="submit" class="btn btn-success btn-lg" name="add" value="Ajouter" />
		</div>
	</div>
	</div>
</form>



<h2>Modification</h2>

<?php
$i = 0;
foreach ($lieux as $lieu)
{
	echo '
	<div class="col-md-3">
	<form method="POST" action="" role="form" class="panel panel-info">
	<div class="panel-heading">
		<a href="#lieu'.$lieu->lieu_id.'" onclick="$(\'#lieu'.$lieu->lieu_id.'\').toggle();"><h3 class="panel-title">
			<span class="glyphicon glyphicon-chevron-down pull-right"></span>
			'.$lieu->lieu_nom.'
		</h3></a>
	</div>
	<div class="panel-body" id="lieu'.$lieu->lieu_id.'" style="display:none;">

		<div class="form-group">
			<label for="nom">Lieu</label>
			<input type="text" name="nom" id="nom" value="'.$lieu->lieu_nom.'" class="form-control" />
		</div>

		<div class="form-group">
			<label for="adresse">Détails</label>
			<textarea name="adresse" id="adresse" class="form-control">'.$lieu->lieu_adresse.'</textarea>
		</div>

		<div class="form-group">
		<label for="gmap">Lien Google Maps</label>
		<input type="text" name="gmap" id="gmap" value="'.$lieu->lieu_gmap.'" class="form-control" />
		</div>

		<div class="form-group">
			<label for="lat">Coordonnées GPS</label>
			<input type="text" class="form-control" name="lat" id="lat" value="'.$lieu->lieu_lat.'" placeholder="Latitude" />
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="lg" id="lg" value="'.$lieu->lieu_lg.'" placeholder="Longitude" />
		</div>	

		<input type="hidden" name="id" value="'.$lieu->lieu_id.'" />

		<div class="text-center">
			<input type="submit" class="btn btn-success" name="edit" value="Modifier" />
			<input type="submit" class="btn btn-danger" name="del" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce lieu ?\');" />
		</div>
	</div>
	</form>
	</div>';

	$i++;
}
?>