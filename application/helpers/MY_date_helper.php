<?php

function sql_to_human($sql, $format='litteral') {
	//$tableauJours = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'sameidi', 'dimanche');
	$tableauMois = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');

	if ($format == 'litteral')
	{
		$ensemble = explode('-', $sql);
		$date = $ensemble[2].' '.$tableauMois[$ensemble[1]-1].' '.$ensemble[0];
	}
	else
		$date = mdate('%d/%m/%Y - %H:%i', mysql_to_unix($sql));
	 
	return $date;
}

function sql_to_horaire($sql) {
	$v = explode(' ', $sql);
	return sql_to_duree($v[1]);
}

function sql_to_duree($sql) {
	$v = explode(':', $sql);
	return $v[0].'h'.$v[1];
}

function short_date($sql) {
	$tableauJours = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
	$date = mysql_to_unix($sql);
	if (date('d') == date('d', $date)) $jour = 'aujourd\'hui';
	else if (date('d')+1 == date('d', $date)) $jour = 'demain';
	else if (date('d') == date('d', $date)+1) $jour = 'hier';
	else $jour = $tableauJours[date('N', $date)-1];

	return $jour.' à '.mdate('%H:%i', $date);
}