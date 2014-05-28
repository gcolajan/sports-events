<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Planning extends MY_Controller {

	public function index()
	{
		$this->load->model('Planning_model', 'plan');

		$this->layout->setTitle('Planning');
		$this->layout->view('planning/index', array('evenements' => $this->plan->all()));
	}

	 // Afficher tout les evenements d'un sport en particulier
	public function sports($id=0,$inutile='')
	{
		$this->load->model('Sports_model', 'sports');
		$this->load->model('Planning_model', 'plan');

		$sport = $this->sports->getSport($id);

		$this->layout->setTitle('Planning de '.$sport->sport_nom);
		$this->load->model('Planning_sports_model', 'plan');
	
		$this->layout->view('planning/sports', array(
			'evenements' => $this->plan->currentlyAndAfter(),
			'sport' => $sport,
			'id' == $id));
	}
/*
	public function sport($id = '')
	{
		if (empty($id)) redirect('/planning', 'refresh');
		$this->load->model('Planning_sports_model', 'plan');

		$this->layout->setTitle('Consultation d\'un événement sportif');
		$this->layout->view('planning/sport', array('evenement' => $this->plan->getSport($id)));
	}*/
/*
	public function animations()
	{
		$this->load->model('Planning_animations_model', 'plan');

		$this->layout->setTitle('Planning des animations');
		$this->layout->view('planning/animations', array('evenements' => $this->plan->getAnimations()));
	}

	public function animation($id = '')
	{
		if (empty($id)) redirect('/planning', 'refresh');
		$this->load->model('Planning_animations_model', 'plan');

		$this->layout->setTitle('Consultations d\'une animation');
		$this->layout->view('planning/animation', array('evenement' => $this->plan->getAnimation()));
	}*/
}