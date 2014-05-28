<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

	public function index()
	{
		$this->load->model('News_model', 'news');

		$message = '';
		if ($this->input->post('add'))
		{
			$this->news->ajouter(
				$this->input->post('contenu'),
				$this->input->post('public'));
			$message = '<p class="alert alert-success">News ajoutée !</p>';
		}

		if ($this->input->post('edit'))
		{
			$this->news->modifier(
				$this->input->post('id'),
				$this->input->post('contenu'),
				$this->input->post('public'));
			$message = '<p class="alert alert-success">News modifiée !</p>';
		}

		if ($this->input->post('del'))
		{
			$this->news->supprimer($this->input->post('id'));
			$message = '<p class="alert alert-success">News supprimée !</p>';
		}

		$this->layout->setTitle('Gestion des news');
		$this->layout->view('admin/news/index', array('news' => $this->news->getNews(), 'message' => $message));
	}
}
