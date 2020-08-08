<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fileupload extends CI_Controller
{
    public function index()
    {
        $data['type'] = "fileuplaod";
        $this->load->view('header', $data);
        $this->load->view('fileupload');
        $this->load->view('footer');
    }
}