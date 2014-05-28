<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ecoles extends MY_Controller {

	public function index()
	{
		$this->load->model('Ecoles_model', 'ecoles');

		$message = '';
		if ($this->input->post('add'))
		{
			$this->ecoles->ajouter(
				$this->input->post('nom'),
				$this->input->post('couleur'));
			$message = '<p class="alert alert-success">École ajoutée !</p>';
		}

		if ($this->input->post('edit'))
		{
			$this->ecoles->modifier(
				$this->input->post('id'),
				$this->input->post('nom'),
				$this->input->post('couleur'));
			$message = '<p class="alert alert-success">École modifiée !</p>';
		}

		if ($this->input->post('del'))
		{
			$this->ecoles->supprimer($this->input->post('id'));
			$message = '<p class="alert alert-success">École supprimée !</p>';
		}

		$this->layout->setTitle('Gestion des écoles');
		$this->layout->view('admin/ecoles/index', array(
			'ecoles' => $this->ecoles->getOnlyEcoles(),
			'message' => $message));
	}
}
