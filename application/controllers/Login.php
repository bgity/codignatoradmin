<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	/* public function index()
	{
		$data["error"] = 0;
		if ($this->input->post()) {
			if ($this->session->userdata("loginattempts")) {
				echo "2";
				$postData = $this->input->post();
				$loginattempts = $this->session->userdata("loginattempts");
				if ($loginattempts > 4) {
					$data["error"] = 1;
					$this->load->view('login', $data);
				} else {
					$auth = $this->Admin_model->adminLogin($postData);
					if ($auth == true) {
						redirect(base_url(), "auto");
					} else {
						$data["error"] = 2;
						$this->load->view('login', $data);
					}
				}
			} else {
				echo "1";
				$this->session->set_userdata("loginattempts", 0);
				$postData = $this->input->post();
				$auth = $this->Admin_model->adminLogin($postData);
				if ($auth == true) {
					redirect(base_url(), "auto");
				} else {
					$data["error"] = 2;
					$this->load->view('login', $data);
				}
			}
		} else {
			$this->load->view('login', $data);
		}
	} */

	public function index()
	{
		$this->load->view('login');
	}

	public function userlogin()
	{
		$postData = $this->input->post();
		$auth = $this->Admin_model->adminLogin($postData);
		if ($auth == 1) {
			echo "1";
		}
		if ($auth == 2) {
			echo "2";
		}
		if ($auth == 3) {
			echo "3";
		}
	}
}