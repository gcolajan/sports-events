<h1><span class="flaticon flaticon-<?php echo url_title($sport->sport_nom); ?>"></span> <?php echo $sport->sport_nom ?> <small>Enregistrer un match</small></h1>

<p id="messageMatch"><?php echo $message; ?></p>

<form method="POST" action="" onsubmit="return matchIsGood();">
	

<div class="col-sm-6">
	<dl class="panel panel-success">
		<dt class="panel-heading"><h3 class="panel-title">Équipe - Sportif 1</h3></dt>
		<dd class="panel-body">

			<div class="form-group">
				<label class="control-label" for="ecole1">École</label>
				<select name="ecole1" id="ecole1" class="form-control" onchange="$('.equipes1').hide();$('#equipe1_'+this.value).show();">
				<?php
				foreach ($ecoles as $e)
					echo '<option value="'.$e->ecole_id.'">'.$e->ecole_nom.'</option>';
				?>
				</select>
			</div>

			<?php
			foreach ($ecoles as $ecole)
			{
				echo '<div id="equipe1_'.$ecole->ecole_id.'" class="form-group equipes1" style="display:none;">
				<label class="control-label">Équipes de '.$ecole->ecole_nom.'</label>
				<select name="equipe1['.$ecole->ecole_id.']" class="form-control">
					<option disabled selected>N°1</option>';
				if (isset($equipes[$ecole->ecole_id]))
					foreach ($equipes[$ecole->ecole_id] as $e)
						echo '<option value="'.$e->equipe_id.'">'.$e->equipe_nom.'</option>';
				echo '</select></div>';
			}

			?>

			<div class="checkbox">
				<label for="checkautre1">
				<input type="checkbox" id="checkautre1" name="autre1" value="1" onclick="$('#autre1').toggle();" /> Créer une équipe</label>
			</div>

			<dl class="panel panel-default" id="autre1" style="display:none;">
				<dt class="panel-heading"><h3 class="panel-title">Créer une équipe ou un sportif</h3></dt>
				<dd class="panel-body form-horizontal">

					<div class="form-group">
					    <label for="nom1" class="col-sm-2 control-label">Nom</label>
					    <div class="col-sm-10">
							<input type="text" id="nom1" name="nom1" class="form-control" />
					    </div>
					</div>
				</dd>
			</dl>

		<input id="score1" name="score1" type="number" placeholder="Score" required pattern="[0-9]+" class="input-lg form-control" />
		</dd>
	</dl>
</div>

<div class="col-sm-6">
	<dl class="panel panel-success">
		<dt class="panel-heading"><h3 class="panel-title">Équipe - Sportif 2</h3></dt>
		<dd class="panel-body">

			<div class="form-group">
				<label class="control-label" for="ecole2">École</label>
				<select name="ecole2" id="ecole2" class="form-control" onchange="$('.equipes2').hide();$('#equipe2_'+this.value).show();">
				<?php
				foreach ($ecoles as $e)
					echo '<option value="'.$e->ecole_id.'">'.$e->ecole_nom.'</option>';
				?>
				</select>
			</div>

			<?php
			foreach ($ecoles as $ecole)
			{
				echo '<div id="equipe2_'.$ecole->ecole_id.'" class="form-group equipes2" style="display:none;">
				<label class="control-label">Équipes de '.$ecole->ecole_nom.'</label>
				<select name="equipe2['.$ecole->ecole_id.']" class="form-control">
					<option disabled selected>N°1</option>';
				if (isset($equipes[$ecole->ecole_id]))
					foreach ($equipes[$ecole->ecole_id] as $e)
						echo '<option value="'.$e->equipe_id.'">'.$e->equipe_nom.'</option>';
				echo '</select></div>';
			}
			?>

			<div class="checkbox">
				<label for="checkautre2">
				<input type="checkbox" id="checkautre2" name="autre2" value="1" onclick="$('#autre2').toggle();" /> Créer une équipe</label>
			</div>

			<dl class="panel panel-default" id="autre2" style="display:none;">
				<dt class="panel-heading"><h3 class="panel-title">Créer une équipe ou un sportif</h3></dt>
				<dd class="panel-body form-horizontal">

					<div class="form-group">
					    <label for="nom2" class="col-sm-2 control-label">Nom</label>
					    <div class="col-sm-10">
							<input type="text" id="nom2" name="nom2" class="form-control" />
					    </div>
					</div>
				</dd>
			</dl>

		<input id="score2" name="score2" type="number" placeholder="Score" required pattern="[0-9]+" class="input-lg form-control" />
		</dd>
	</dl>
</div>

<div class="text-center">
	<input type="submit" name="add" value="Valider !" class="btn btn-default btn-lg" />
</div>

</form>