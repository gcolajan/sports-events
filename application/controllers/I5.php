<?php defined('BASEPATH') OR exit('No direct script access allowed');

class I5 extends MY_Controller {

	public function index()
	{
		$this->load->model('Planning_model', 'plan');
		$this->load->model('News_model');

		$this->layout->setTitle();
		$this->layout->view('i5/index', array(
			'evenements' => $this->plan->currently(),
			'nouvelles' => $this->News_model->getPublicNews()));
	}

	public function informations()
	{
		$this->layout->setTitle('Informations pratiques');
		$this->layout->view('i5/infos');
	}

	public function contacts()
	{
		$this->load->model('Contacts_model', 'contacts');

		$this->layout->setTitle('Contacts');
		$this->layout->view('i5/contacts', array('contacts' => $this->contacts->getContacts()));
	}

	public function apropos()
	{
		$this->layout->setTitle('À propos');
		$this->layout->view('i5/apropos');
	}
}