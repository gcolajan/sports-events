<?php
// On étend grâce à ce fichier préfixé en "MY_" le helper "url_helper"
// On peut modifier ou ajouter des fonctions au helper

function url_title($string, $delimiteur='-', $tolower=TRUE)
{
	$string = utf8_decode($string);
	$string = str_replace(array('&amp;', '(', ')'), array('&', '', ''), $string);
	$string = html_entity_decode($string);
	$string = strtr(
	strtr($string,
	utf8_decode('ŠŽšžŸÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ?$,&:()!{}."§_#=/\\;°'),
	utf8_decode('SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy---------------------')),
	array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', '@' => '-at-',
	'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE',
	'æ' => 'ae', 'µ' => 'u', '+' => '-', '€' => 'euro', '$' => 'usd')
	);
	$string = preg_replace('|[^A-Z0-9-]|i', $delimiteur, $string);
	$string = preg_replace('|[\-]+|i', $delimiteur, $string);
	$string = preg_replace('|-$|i', '', $string);
	if(empty($string)) return 'nan';
	if ($tolower == TRUE) $string = strtolower($string);
	return utf8_encode($string);
}


// On modifie le comportement la fonction redirect afin qu'elle prenne en compte les notifications
function redirect($uri = '', $method = 'location', $http_response_code = 302)
{
	// On va chercher notre instance de CI et on transmet les notifs
	$CI =& get_instance();
	//$CI->session->apply_notifications();
	
	if ( ! preg_match('#^https?://#i', $uri))
	{
		$uri = site_url($uri);
	}

	switch($method)
	{
		case 'refresh'	: header("Refresh:0;url=".$uri);
			break;
		default			: header("Location: ".$uri, TRUE, $http_response_code);
			break;
	}
	exit;
}
