<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lieux extends MY_Controller {

	public function index()
	{
		$this->load->model('Lieux_model', 'lieux');

		$message = '';
		if ($this->input->post('add'))
		{
			$this->lieux->ajouter(
				$this->input->post('nom'),
				$this->input->post('adresse'),
				$this->input->post('gmap'),
				str_replace(',', '.', $this->input->post('lat')),
				str_replace(',', '.', $this->input->post('lg')));
			$message = '<p>Lieu ajouté !</p>';
		}

		if ($this->input->post('edit'))
		{
			$this->lieux->modifier(
				$this->input->post('id'),
				$this->input->post('nom'),
				$this->input->post('adresse'),
				$this->input->post('gmap'),
				str_replace(',', '.', $this->input->post('lat')),
				str_replace(',', '.', $this->input->post('lg')));
			$message = '<p>Lieu modifié !</p>';
		}

		if ($this->input->post('del'))
		{
			$this->lieux->supprimer($this->input->post('id'));
			$message = '<p>Lieux supprimé !</p>';
		}

		$this->layout->setTitle('Gestion des lieux');
		$this->layout->view('admin/lieux/index', array('lieux' => $this->lieux->getLieux(), 'message' => $message));
	}
}
