<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Start extends CI_Controller
{

	public function index()
	{
		if ($this->Admin_model->verifyUser()) {
			$data['type'] = "dashboard";
			$this->load->view('header', $data);
			$this->load->view('welcome_message');
			$this->load->view('footer');
		}
	}
}