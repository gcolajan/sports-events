<h1>Gestion des contacts</h1>

<?php echo $message; ?>

<h2>Ajout</h2>


<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Ajouter un contact</h3>
	</div>
	<div class="panel-body">
		<form method="POST" action="">

		<div class="form-group">
			<label for="nom">Nom du contact</label>
			<input type="text" name="nom" id="nom" class="form-control" />
		</div>

		<div class="form-group">
			<label for="role">Rôle</label>
			<input type="text" name="role" id="role" placeholder="Rôle" class="form-control" />
		</div>

		<div class="form-group">
			<label for="tel">Numéro <small>(sans séparateurs)</small></label>
			<input type="tel" name="tel" id="tel" pattern="[0-9]{10}" placeholder="0123456789" class="form-control" />
		</div>

		<div class="text-center">
			<input type="submit" name="add" value="Ajouter" class="btn btn-success btn-lg" />
		</div>

		</form>
	</div>
</div>


<h2>Modification</h2>

<?php
foreach ($contacts as $contact)
{
	echo '
<div class="col-md-3">
<form method="POST" action="">
<div class="panel panel-info">
	<div class="panel-heading">
		<input type="text" name="nom" value="'.$contact->contact_nom.'" class="form-control" />
	</div>
	<div class="panel-body">

		<div class="form-group">
			<label for="role">Rôle</label>
			<input type="text" name="role" id="role" value="'.$contact->contact_role.'" placeholder="Rôle" class="form-control" />
		</div>

		<div class="form-group">
			<label for="tel">Numéro <small>(sans séparateurs)</small></label>
			<input type="tel" name="tel" value="0'.$contact->contact_numero.'" pattern="[0-9]{10}" placeholder="Numéro" class="form-control" />
		</div>


		<input type="hidden" name="id" value="'.$contact->contact_id.'" />

		<div class="text-center">
			<input type="submit" name="edit" value="Modifier" class="btn btn-success" />
			<input type="submit" name="del" value="Supprimer" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce contact ?\');" />
		</div>
	</div>
</div>
</form>
</div>';
}
?>