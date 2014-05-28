<h1>Gestion des participation sportives</h1>

<?php
echo $message;

function concentrate($added, $toAdd, $ecole)
{
	if (count($added) > 0)
	{
		echo '
		<div class="panel panel-default">
			<div class="panel-heading">Suppression</div>
			<div class="panel-body">
				<form method="POST" action="" class="form-group">
				<input type="hidden" name="ecole" value="'.$ecole.'" />
				<ul>';
				foreach($added as $s)
				{
					echo '<button type="submit" class="btn btn-danger" name="del" value="'.$s->sport_id.'" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer « '.$s->sport_nom.' »\');"><span class="glyphicon glyphicon-remove"></span> '.$s->sport_nom.'</button> ';
				}
				echo '
				</ul>
				</form>
			</div>
		</div>';
	}
	else
		echo '<p class="alert alert-warning">Cette école ne participe à aucun sport.</p>';


	if (count($toAdd) > 0)
	{
		echo '
		<div class="panel panel-default">
			<div class="panel-heading">Ajout</div>
			<div class="panel-body">
				<form method="POST" action="">
				<input type="hidden" name="ecole" value="'.$ecole.'" />
				<div class="form-group">
					<select multiple name="sports[]" class="form-control">';
					foreach($toAdd as $s)
					{
						echo '<option value="'.$s->sport_id.'">'.$s->sport_nom.'</option>';
					}
					echo '</select>
				</div>
				<div class="text-center"><button type="submit" name="add" value="add" class="btn btn-default btn-lg">Valider</button></div>
				</form>
			</div>
		</div>';
	}
	else
		echo '<p class="alert alert-success">Cette école participe à tous les sports.</p>';
}


$ecole = 0;
$redindexedSports = array();
foreach ($sports as $s)
	$redindexedSports[$s->sport_id] = $s;

for ($i = 0 ; $i < count($ecoles) ; $i++)
{
	if ($ecole != $ecoles[$i]->ecole_id)
	{
		if ($ecole != 0)
		{
			concentrate($added, $toAdd, $ecole);
			echo '</div></div>';
		}

		$toAdd = $redindexedSports;
		$added = array();

		echo '<div class="panel panel-info">
		<div class="panel-heading">
			<a href="#ecole'.$ecoles[$i]->ecole_id.'" style="display:block" onclick="$(\'.ecole\').hide(); $(\'#ecole'.$ecoles[$i]->ecole_id.'\').toggle();">
				<span class="glyphicon glyphicon-chevron-down pull-right"></span>
				'.$ecoles[$i]->ecole_nom.'
			</a>
		</div>
		<div class="panel-body ecole" id="ecole'.$ecoles[$i]->ecole_id.'" style="display:none;">';
	}

	if (!empty($ecoles[$i]->p_sport))
	{
		$added[] = $toAdd[$ecoles[$i]->p_sport];
		unset($toAdd[$ecoles[$i]->p_sport]);
	}

	$ecole = $ecoles[$i]->ecole_id;
}

concentrate($added, $toAdd, $ecole);

?>
</div></div>