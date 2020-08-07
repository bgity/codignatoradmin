<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgotpassword extends CI_Controller
{
    public function index()
    {
        $this->load->view('forgotpassword');
    }

    public function resetpassword()
    {
        $postData = $this->input->post();
        $forgotPassword = $this->Admin_model->forgotPassword($postData);
        if ($forgotPassword == 1) {
            echo "1";
        } elseif ($forgotPassword == 2) {
            echo "2";
        }
    }
}