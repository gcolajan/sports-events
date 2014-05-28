<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->loadAuthentification();
	}

	private function loadAuthentification() {

		// Si non connecté et essaie d'accéder à l'admin, on redirige vers l'authentification
		if (!$this->session->userdata('authenticated') && $this->uri->segment(1) == 'admin')
		{
			redirect('/auth', 'refresh');
			exit();
		}
	}
}
