<?php

class SizeTitle {
	const FULL = 3;
	const SHORT = 2;
	const TINY = 1;
}

function generateTitle($titre, $size=SizeTitle::FULL)
{
	// Nom de la page
	$title = $titre;

	// Contrôleur appelé (module)
	if ($size > SizeTitle::SHORT)
		$title .= ' - '; //.t("class_nom");

	// Nom du site
	if ($size > SizeTitle::TINY)
		$title .= ' - '.config_item('header_nom_site');

	return $title;
}

function generateMeta() {
	$content = '<meta http-equiv="Content-Type" content="text/html; charset='.config_item('charset').'" />';

	foreach (config_item('header_meta') as $name => $meta)
		if (!empty($meta))
			$content .= "\n\t".'<meta name="'.$name.'" content="'.$meta.'" />';

	return $content."\n";

}