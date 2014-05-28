<!-- Fixed navbar top - bottom / test-->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand glyphicon glyphicon-step-backward" href="javascript:history.go(-1);" title="Page précédente"></a>
			<a class="navbar-brand" id="logo" href="<?php echo site_url('/');?>">High Five 2014</a>

		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?php echo ($this->uri->segment(1) == 'resultats') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('/resultats'); ?>">Résultats</a></li>
				<li <?php echo ($this->uri->segment(1) == 'planning') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('/planning'); ?>">Planning</a></li>
				<li <?php echo ($this->uri->segment(1) == 'lieux') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('/lieux'); ?>">Lieux</a></li>
				<li <?php echo ($this->uri->segment(1) == 'i5' && $this->uri->segment(2) == 'informations') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('/i5/informations'); ?>">Infos pratiques</a></li>
				<?php if ($this->session->userdata('authenticated')): ?>
				<li <?php echo ($this->uri->segment(1) == 'admin') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('/admin'); ?>">Administration</a></li>
				<li><a href="<?php echo site_url('/auth/stop'); ?>" title="Déconnexion"><span class="glyphicon glyphicon-log-out"></span></a></li>
				<?php endif; ?>
				<li></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>

