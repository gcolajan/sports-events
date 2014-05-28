<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lieux extends MY_Controller {

	public function index()
	{
		$this->load->model('Lieux_model', 'lieux');
			$this->layout->setTitle('Lieux');
			$this->layout->view('lieux/index', array('lieux' => $this->lieux->getLieux()));

	}

	public function consult($id='')
	{
		if (empty($id)) redirect('/lieux', 'refresh');
		
		$this->load->model('Lieux_model', 'lieux');

		$this->layout->setTitle('Consultation');
		$this->layout->view('lieux/lieu', array('lieu' => $this->lieux->getLieu($id)));
	}
}