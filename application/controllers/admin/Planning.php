<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Planning extends MY_Controller {

	public function index()
	{
		$this->load->model('Lieux_model', 'lieux');
		$this->load->model('Sports_model', 'sports');
		$this->load->model('Planning_model', 'planning');
		$this->load->model('Planning_animations_model', 'pa');
		$this->load->model('Planning_sports_model', 'ps');

		$jours = array(
			'2014-04-10' => "jeudi 10",
			'2014-04-11' => "vendredi 11",
			'2014-04-12' => "samedi 12");

		$message = '';

		if ($this->input->post('add'))
		{
			$horaire = $this->input->post('jour').' '.$this->input->post('horaire').':00';
			$duree = $this->input->post('duree');

			if ($this->input->post('type') == 'animation')
				$this->pa->ajouter(
					$this->input->post('lieu'),
					$horaire,
					$duree,
					$this->input->post('animation'),
					$this->input->post('desc'));
			else // sport
				$this->ps->ajouter(
					$this->input->post('lieu'),
					$horaire,
					$duree,
					$this->input->post('sport'),
					$this->input->post('desc'));
			$message = '<p class="alert alert-success">Évènement créé !</p>';
		}

		if ($this->input->post('edit'))
		{
			$horaire = $this->input->post('jour').' '.$this->input->post('horaire').':00';
			$duree = $this->input->post('duree');

			if ($this->input->post('type') == 'animation')
				$this->pa->modifier(
					$this->input->post('id'),
					$this->input->post('lieu'),
					$horaire,
					$duree,
					$this->input->post('animation'),
					$this->input->post('desc'));
			else // sport
				$this->ps->modifier(
					$this->input->post('id'),
					$this->input->post('lieu'),
					$horaire,
					$duree,
					$this->input->post('sport'),
					$this->input->post('desc'));
			$message = '<p class="alert alert-success">Évènement modifié !</p>';
		}

		if ($this->input->post('del'))
		{

			if ($this->input->post('type') == 'animation')
				$this->pa->supprimer($this->input->post('id'));
			else // sport
				$this->ps->supprimer($this->input->post('id'));
			$message = '<p class="alert alert-success">Évènement supprimé !</p>';
		}


		$this->layout->setTitle('Gestion du planning');
		$this->layout->view('admin/planning/index', array(
			'message' => $message,
			'lieux' => $this->lieux->getLieux(),
			'sports' => $this->sports->getSports(),
			'evts' => $this->planning->all(),
			'jours' => $jours));
	}
}
