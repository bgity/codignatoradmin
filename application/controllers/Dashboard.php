<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		if ($this->Admin_model->verifyUser()) {
			if ($this->session->userdata('level') === '1') {
				$data['type'] = "dashboard";
				$this->load->view('header', $data);
				$this->load->view('dashboard');
				$this->load->view('footer');
			} else {
				echo "Access Denied";
			}
		}
	}
	public function admin()
	{
		if ($this->Admin_model->verifyUser()) {
			if ($this->session->userdata('level') === '2') {
				$data['type'] = "dashboard";
				$this->load->view('header', $data);
				$this->load->view('dashboard');
				$this->load->view('footer');
			} else {
				echo "Access Denied";
			}
		}
	}
}