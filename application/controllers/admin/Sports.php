<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sports extends MY_Controller {

	public function index()
	{
		$this->load->model('Sports_model', 'sports');

		$message = '';
		if ($this->input->post('add'))
		{
			$this->sports->ajouter(
				$this->input->post('nom'),
				$this->input->post('typeev'),
				$this->input->post('showmatch'),
				$this->input->post('showclass'),
				( ($this->input->post('typeclass') == 'ecole') ? 0 : 1));
			$message = '<p class="alert alert-success">Sport ajouté !</p>';
		}

		if ($this->input->post('edit'))
		{
			$this->sports->modifier(
				$this->input->post('id'),
				$this->input->post('nom'),
				$this->input->post('typeev'),
				$this->input->post('showmatch'),
				$this->input->post('showclass'),
				( ($this->input->post('typeclass') == 'ecole') ? 0 : 1));
			$message = '<p class="alert alert-success">Sport modifié !</p>';
		}

		if ($this->input->post('del'))
		{
			$this->sports->supprimer($this->input->post('id'));
			$message = '<p class="alert alert-success">Sport supprimé !</p>';
		}

		$this->layout->setTitle('Gestion des sports');
		$this->layout->view('admin/sports/index', array(
			'sports' => $this->sports->getSports(),
			'types' => $this->sports->getTypes(),
			'message' => $message));
	}
}
