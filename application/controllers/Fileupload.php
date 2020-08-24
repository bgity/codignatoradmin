<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fileupload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fileupload_model', 'fileupload');
    }
    public function index()
    {
        $data['type'] = "fileuplaod";
        $this->load->view('header', $data);
        $this->load->view('fileupload');
        $this->load->view('footer');
    }

    public function fileUpload_list()
    {
        $this->load->helper('url');
        $list = $this->fileupload->get_fileupload_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $fileupload) {
            $no++;
            $row = array();
            $row[] = $fileupload->sale_channel;
            $row[] = $fileupload->file_name;
            $row[] = $fileupload->file_type;
            $row[] = $fileupload->upload_time;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->fileupload->count_all_record(),
            "recordsFiltered" => $this->fileupload->count_filtered_record(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function uploadCsv()
    {
        echo "ddddddddddd";

        $config['upload_path'] = "resources/csv";
        $config['allowed_types'] = 'csv';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload("file")) {
            echo "ffffffffffffff";
            $data = array('upload_data' => $this->upload->data());
            print_r($data);
            $saleChannel = $this->input->post('sale_channel');
            $fileType = $this->input->post('file_type');
            $csvFile = $data['upload_data']['file_name'];
            $result = $this->upload_model->save_upload($saleChannel, $fileType, $csvFile);
            echo json_decode($result);
        }
    }
}