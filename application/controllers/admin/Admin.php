<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function index()
	{
		$this->layout->setTitle('Administration');
		$this->layout->view('admin/index');
	}
}
