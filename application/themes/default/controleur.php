<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ThemeDefault {

	// Une zone doit correspondre à un fichier
	private $zones = array('header' => '', 'menu' => '', 'footer' => '');
	private $layout;

	public function __construct(Layout $layout) {
		$this->layout = $layout;

		$CI = &get_instance();
		$this->loadCSS();
		$this->loadJS();
	}

	private function loadCSS() {
		$this->layout->ajouterCSS('bootstrap.min');
		$this->layout->ajouterCSS('bootstrap-theme.min');
		$this->layout->ajouterCSS('theme');
		$this->layout->ajouterCSS('style');

	}

	private function loadJS() {
		$this->layout->ajouterJS('jquery.min');
		$this->layout->ajouterJS('bootstrap.min');
		$this->layout->ajouterJS('adminTools');
		$this->layout->ajouterJS('switchPlanning');
	}

	public function setZone($var, $tableau=array()) {

		// Mise en place du contenu de la zone
		$this->zones[$var] = $tableau;

		// Appel éventuel de la méthode associée à la zone (pouvant se servir de $this->zones[$var])
		$methodName = 'set_'.$var;
		if(method_exists($this, $methodName))
			$this->$methodName($tableau);
	}

	// Fournit une zone en particulier
	public function getZone($var) {
		if (!empty($this->zones[$var]))
			return $this->zones[$var];
	}

	// Fournit toutes les zones
	public function getZones() {
		return $this->zones;
	}

}