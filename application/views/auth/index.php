<h1>Connexion</h1>

<?php echo $msg; ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Authentification</h3>
  </div>
  <div class="panel-body">
	<form method="POST" action="">

		<div class="form-group">
			<input type="text" name="ident" id="ident" placeholder="Identifiant" class="form-control"  />
		</div>
		<div class="form-group">
			<input type="password" name="passwd" id="passwd" placeholder="Mot de passe" class="form-control"  />
		</div>

		<div class="text-center">
			<input type="submit" value="Se connecter" class="btn btn-default" />
		</div>
	</form>

  </div>
</div>