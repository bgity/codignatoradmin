<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chart extends CI_Controller
{
    public function index()
    {
        $data['type'] = "chart";
        $this->load->view('header', $data);
        $this->load->view('chart');
        $this->load->view('footer');
    }
}