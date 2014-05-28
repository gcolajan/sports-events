<h1>Gestion des news</h1>

<?php echo $message; ?>

<form method="POST" action="">
	<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Ajout</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="contenu">Contenu</label>
			<textarea name="contenu" id="contenu" class="form-control" placeholder="<h2>Titre</h2> <p>Paragraphe</p>"></textarea>
		</div>


		<div class="form-group">
			<label for="public1">Publication</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default active">
			    <input type="radio" name="public" id="public1" value="1" checked> Visible
			  </label>
			  <label class="btn btn-default">
			    <input type="radio" name="public" id="public2" value="0"> Cachée
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
foreach ($news as $n)
{
	echo '
	<div class="col-md-3">
	<form method="POST" action="" role="form" class="panel panel-info">
	<div class="panel-heading">
		<a href="#lieu'.$n->news_id.'" onclick="$(\'#lieu'.$n->news_id.'\').toggle();"><h3 class="panel-title">
			Nouvelle du '.sql_to_human($n->news_date, 'unix').'
		</h3></a>
	</div>
	<div class="panel-body" id="lieu'.$n->news_id.'" style="display:none;">

		<div class="form-group">
			<label for="contenu">Contenu</label>
			<textarea name="contenu" id="contenu" class="form-control">'.$n->news_contenu.'</textarea>
		</div>


		<div class="form-group">
			<label for="public1">Publication</label><br />
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-default '.( ($n->news_public) ? 'active' : '').'">
			    <input type="radio" name="public" id="public1" value="1" '.( ($n->news_public) ? 'checked' : '').'> Visible
			  </label>
			  <label class="btn btn-default '.( !($n->news_public) ? 'active' : '').'">
			    <input type="radio" name="public" id="public2" value="0" '.( !($n->news_public) ? 'checked' : '').'> Cachée
			  </label>
			</div>
		</div>

		<input type="hidden" name="id" value="'.$n->news_id.'" />

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