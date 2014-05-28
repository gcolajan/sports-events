<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller {

	public function index()
	{
		$this->load->model('Contacts_model', 'contacts');

		$message = '';
		if ($this->input->post('add'))
		{
			$this->contacts->ajouter($this->input->post('nom'), $this->input->post('role'), $this->input->post('tel'));
			$message = '<p>Contact ajouté !</p>';
		}

		if ($this->input->post('edit'))
		{
			$this->contacts->modifier($this->input->post('id'), $this->input->post('nom'), $this->input->post('role'), $this->input->post('tel'));
			$message = '<p>Contact modifié !</p>';
		}

		if ($this->input->post('del'))
		{
			$this->contacts->supprimer($this->input->post('id'));
			$message = '<p>Contact supprimé !</p>';
		}

		$this->layout->setTitle('Gestion des contacts');
		$this->layout->view('admin/contacts/index', array('contacts' => $this->contacts->getContacts(), 'message' => $message));
	}
}
