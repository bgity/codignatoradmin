<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Person extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('person_model', 'person');
    }

    public function index()
    {

        $this->load->helper('url');
        $this->load->view('person_view');
    }
    protected function generateSalt()
    {
        $salt = "xiORG17N6ayoEn6X3";
        return $salt;
    }
    public function ajax_list()
    {
        $this->load->helper('url');
        $list = $this->person->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            //$row[] = '<input type="checkbox" class="data-check" value="'.$person->id.'">';
            $row[] = $person->firstName;
            $row[] = $person->lastName;
            $row[] = $person->username;
            $row[] = $person->gender;
            $row[] = $person->address;
            $row[] = $person->dob;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $person->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $person->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->person->count_all(),
            "recordsFiltered" => $this->person->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->person->get_by_id($id);
        $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $updateForm = 'add';
        $this->_validate($updateForm);
        $adminVal =  $this->input->post('userName');
        $adminCeck = $this->person->adminCheck($adminVal);
        print_r($adminCeck);
        if ($adminCeck == TRUE) {
            echo json_encode(array("status" => '3'));
        } else {
            $data = array(
                'firstName' => $this->input->post('firstName'),
                'lastName' => $this->input->post('lastName'),
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
                'dob' => $this->input->post('dob'),
                'username' => $this->input->post('userName'),
                'business_unit' => $_SESSION['business_unit'],
                'access_level' => $this->input->post('role'),
                'password' => $this->input->post('userPassword'),
            );

            $insert = $this->person->save($data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function ajax_update()
    {
        $updateForm = 'update';
        $this->_validate($updateForm);
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'dob' => $this->input->post('dob'),
            'username' => $this->input->post('userName'),
            'access_level' => $this->input->post('role'),
            //'password' => $this->db->escape(strip_tags(md5($salt . $this->input->post('userPassword'))))
        );

        $this->person->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->person->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->person->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }

    private function _validate($updateForm)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('firstName') == '') {
            $data['inputerror'][] = 'firstName';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('lastName') == '') {
            $data['inputerror'][] = 'lastName';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('dob') == '') {
            $data['inputerror'][] = 'dob';
            $data['error_string'][] = 'Date of Birth is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('gender') == '') {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Please select gender';
            $data['status'] = FALSE;
        }

        if ($this->input->post('address') == '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Addess is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('role') == '') {
            $data['inputerror'][] = 'role';
            $data['error_string'][] = 'Role is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('userName') == '') {
            $data['inputerror'][] = 'userName';
            $data['error_string'][] = 'username is required';
            $data['status'] = FALSE;
        }
        if ($updateForm == 'add') {
            if ($this->input->post('userPassword') == '') {
                $data['inputerror'][] = 'userPassword';
                $data['error_string'][] = 'Password is required';
                $data['status'] = FALSE;
            }
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}