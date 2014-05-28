<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Resultats extends MY_Controller {

	public function index()
	{
		$this->load->model('Participations_model', 'participations');

		// Refactorisation des résultats par sport
		$cleq = array();
		$classementEquipes = $this->participations->getClassementEquipes();
		foreach ($classementEquipes as $ce)
			$cleq[$ce->sport_id][] = $ce;

		$this->layout->setTitle('Résultats');
		$this->layout->view('resultats/index', array(
			'parts' => $this->participations->getSchoolsBySports(),
			'cleq' => $cleq));
	}

	// Résultats par sports
	public function sport($sport=0, $inutile='')
	{
		$this->load->model('Participations_model', 'participations');
		$this->load->model('Sports_model', 'sports');

		$sportReq = $this->sports->getSport($sport);
		$matchs = $this->participations->getAllMatchs($sport);

		$parts = $this->participations->getParticipationsBySport($sport);
		$participations = array();
		foreach ($parts as $p)
			$participations[$p->p_id] = $p;

		$this->layout->setTitle('Liste des matchs de '.$sportReq->sport_nom);
		$this->layout->view('resultats/sport', array(
			'participations' => $participations,
			'sport' => $sportReq,
			'matchs' => $matchs));
	}

	// Hall of Fame
	public function hof($participation=0, $inutile1='', $inutile2='')
	{
		$this->load->model('Participations_model', 'participations');

		$parts = $this->participations->getParticipationsByPart($participation);
		$participations = array();
		foreach ($parts as $p)
			$participations[$p->p_id] = $p;

		$matchs = $this->participations->getMatchs($participation);

		$this->layout->setTitle('Liste des matchs de '.$participations[$participation]->ecole_nom.' en '.$participations[$participation]->sport_nom);
		$this->layout->view('resultats/hof', array(
			'part' => $participation,
			'participations' => $participations,
			'matchs' => $matchs));
	}
}