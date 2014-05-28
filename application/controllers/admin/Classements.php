<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Classements extends MY_Controller {

	public function index() {
		$this->load->model('Sports_model', 'sports');

		$this->layout->setTitle('Classements');
		$this->layout->view('admin/classements/index', array('sports' => $this->sports->getSports()));
	}

	public function sport($id=0, $inutile='')
	{
		$this->load->model('Sports_model', 'sports');
		$this->load->model('Equipes_model', 'equipes');
		$this->load->model('Participations_model', 'participations');


		if ($this->input->post('sended'))
		{
			if ($this->input->post('typeRank') == 0) // par école
			{
				// On lui donne en entrée un tableau associatif p_id => p_classement
				$this->participations->majClassement($this->input->post('classement'));
			}
			else // par équipe
			{
				// On lui donne en entrée un tableau associatif equipe_id => equipe_classement
				$this->equipes->majClassement($this->input->post('classement'));
			}
		}

		// Actualisation des droits
		if ($this->input->post('changeshow'))
			$this->sports->modifierDroits($id, $this->input->post('showclass'), $this->input->post('showres'));

		$equipes = '';
		$partReq = '';

		// On regarde les informations qu'on a sur ce sport
		$infos = $this->sports->getSport($id);

		// Écoles ayant une participation à ce sport
		if ($infos->sport_typeRank == 0) // par école
		{
			$partReq = $this->participations->getParticipationsBySport($id);
		}
		else // par équipe
		{
			// Il faut récupérer les différentes équipes jouant au sport actuel
			$equipes = $this->equipes->getEquipesPratiquant($id);
		}

		$this->layout->setTitle('Classements');
		$this->layout->view('admin/classements/sport', array(
			'infos' => $infos,
			'equipes' => $equipes,
			'ecoles' => $partReq));
	}
}