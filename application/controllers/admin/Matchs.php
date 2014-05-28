<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Matchs extends MY_Controller {

	public function index()
	{
		$this->load->model('Sports_model', 'sports');

		$this->layout->setTitle('Gestion des matchs');
		$this->layout->view('admin/matchs/index', array('sports' => $this->sports->getSports()));
	}

	public function ajouter($sport=0, $inutile='')
	{
		$this->load->model('Participations_model', 'participations');
		$this->load->model('Equipes_model', 'equipes');
		$this->load->model('Sports_model', 'sports');
		$this->load->model('Matchs_model', 'matchs');

		$message = '';

		// Réception du formulaire d'ajout
		if ($this->input->post('add'))
		{
			$ecole1 = $this->input->post('ecole1');
			$ecole2 = $this->input->post('ecole2');

			if ($this->input->post('autre1')) {
				$part = $this->participations->getIdParticipation(
					$sport,
					$ecole1);
				$eq1 = $this->equipes->add($part, $this->input->post('nom1'));
			}
			else
				$eq1 = $this->input->post('equipe1')[$ecole1];


			if ($this->input->post('autre2')) {
				$part = $this->participations->getIdParticipation(
					$sport,
					$ecole2);
				$eq2 = $this->equipes->add($part, $this->input->post('nom2'));
			}
			else
				$eq2 = $this->input->post('equipe2')[$ecole2];


			$match = $this->matchs->ajouter(
				$eq1,
				$this->input->post('score1'),
				$eq2,
				$this->input->post('score2'));

			$message = 'Match ajouté : <a href="'.site_url('/resultats/sport/'.$sport.'/'.$inutile.'#match'.$match).'">voir</a> !';
		}

		$reqSport = $this->sports->getSport($sport);
		$equipes = [];
		$reqEquipes = $this->equipes->getEquipesPratiquant($sport);
		foreach ($reqEquipes as $eq)
			$equipes[$eq->ecole_id][] = $eq;

		$this->layout->setTitle('Gestion des matchs de '.$reqSport->sport_nom);
		$this->layout->view('admin/matchs/ajouter', array(
			'equipes' => $equipes,
			'ecoles' => $this->participations->getEcolesByParticipation($sport),
			'sport' => $reqSport,
			'message' => $message));
	}

	// Liste des matchs modifiables (pour un sport donné)
	public function modifier($sport=0, $inutile='')
	{
		$this->load->model('Participations_model', 'participations');
		$this->load->model('Matchs_model', 'matchs');
		$this->load->model('Sports_model', 'sports');


		$message = '';
		if ($this->input->post('edit'))
		{
			$this->matchs->modifier(
				$this->input->post('id'),
				$this->input->post('res1'),
				$this->input->post('res2'));
			$message = 'Match modifié.';
		}

		if ($this->input->post('del'))
		{
			$this->matchs->supprimer($this->input->post('id'));
			$message = 'Match supprimé.';
		}

		$parts = $this->participations->getParticipationsBySport($sport);
		$participations = array();
		foreach ($parts as $p)
			$participations[$p->p_id] = $p;

		$matchs = $this->participations->getAllMatchs($sport);

		$reqSport = $this->sports->getSport($sport);

		$this->layout->setTitle('Modifier les matchs de '.$reqSport->sport_nom);
		$this->layout->view('/admin/matchs/modifier', array(
			'participations' => $participations,
			'matchs' => $matchs,
			'sport' => $reqSport,
			'message' => $message));
	}

	// Modifier un match
	public function corriger($match)
	{

	}
}
