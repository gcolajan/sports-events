<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Participations extends MY_Controller {

	public function index()
	{
		$this->load->model('Participations_model', 'participations');
		$this->load->model('Ecoles_model', 'ecoles');
		$this->load->model('Sports_model', 'sports');

		$message = '';
		if ($this->input->post('add'))
		{
			$this->participations->ajouterPlusieurs($this->input->post('ecole'), $this->input->post('sports'));
			$message = '<p class="alert alert-success">Participation(s) ajoutées !</p>';
		}

		if ($this->input->post('del'))
		{
			if ($this->participations->supprimer($this->input->post('ecole'), $this->input->post('del')))
				$message = '<p class="alert alert-success">Participation sportive supprimée.</p>';
			else
				$message = '<p class="alert alert-danger">La participation sportive n\'a pas pu être supprimée : une équipe concourt sur cette participation.</p>';
		}

		$this->layout->setTitle('Gestion des participations sportives');
		$this->layout->view('admin/participations/index', array(
			'ecoles' => $this->ecoles->getEcoles(),
			'sports' => $this->sports->getSports(),
			'message' => $message));
	}
}
