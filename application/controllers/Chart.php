<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chart extends CI_Controller
{
    public function index()
    {
        //$this->load->view('header');
        $this->load->view('chart');
        //$this->load->view('footer');
    }
}