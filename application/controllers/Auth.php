<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public $user = 'admin';
	public $password = '088495f30901580ddd5171531cd26649';

	public function index()
	{
		$this->layout->setTitle('Authentification');

		// Message par défaut
		$message = '<p class="alert alert-info">Ce site requiert votre identification pour être administré.</p>';

		// Si déjà connecté
		if ($this->session->userdata('authenticated'))
			$message = '<p class="alert alert-info">Vous êtes actuellement connecté, consultez <a href="'.site_url('admin').'">l\'administration</a>.</p>';

		// Si le formulaire a été envoyé
		if ($this->input->post('ident') || $this->input->post('passwd'))
		{
			if ($this->input->post('ident') == $this->user && md5($this->input->post('passwd')) == $this->password)
			{
				$this->session->set_userdata(array('authenticated' => true));
				$message = '<p class="alert alert-success">Vous êtes maintenant connecté : consultez <a href="'.site_url('admin').'">l\'administration</a>.</p>';
			}
			else
				$message = '<p class="alert alert-danger">La connexion a échoué.</p>';
		}

		$this->layout->view('auth/index', array('msg' => $message));
	}


	public function stop()
	{
		$this->layout->setTitle('Déconnexion');
		$this->session->set_userdata(array('authenticated' => false));
		$this->layout->view('auth/deconnexion');
	}
}