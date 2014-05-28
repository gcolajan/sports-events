<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $titre; ?></title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/favicon.png'); ?>" />

	<?php echo $CSS; ?>
	<?php echo $startJS; ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo generateMeta(); ?>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<?php echo $header; ?>

	<?php echo $menu; ?>


	<div class="container theme-showcase" role="main">
		<?php echo $output; ?>
	</div>
		
	<?php echo $footer; ?>

<?php echo $endJS; ?>

</body>
</html>
