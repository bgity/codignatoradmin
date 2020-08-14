<?php defined('BASEPATH') or exit('No direct script access allowed');
class Person_model extends CI_Model
{
    var $table = 'admin';
    var $column_order = array('firstname', 'lastname', 'username', 'gender', 'address', 'dob', null); //set column field database for datatable orderable    
    var $column_search = array('firstname', 'lastname', 'username', 'address'); //set column field database for datatable searchable just firstname , lastname , address are searchable     var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        //print_r($_SESSION);
        //print_r($this->session);
        //$this->db->select($this->select_column);
        if ($_SESSION['level'] == '2') {
            $this->db->where('admin.business_unit', $this->session->userdata('business_unit'));
            $this->db->where('admin.access_level', $this->session->userdata('level'));
            $this->db->where('admin.id !=', $this->session->userdata('admin_id'));
            $this->db->from($this->table);
        } else {
            $this->db->where('admin.business_unit', $this->session->userdata('business_unit'));
            $this->db->where('admin.id !=', $this->session->userdata('admin_id'));
            $this->db->from($this->table);
        }

        // $this->db->join('admin', $this->table . '.business_unit = admin.business_unit');
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing 
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    public function adminCheck($userName)
    {
        $this->db->from($this->table);
        $this->db->where('username', $userName);
        $query = $this->db->get();
        if ($query->num_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /* public function adminAccessLevelCheck($userName, $level)
    {
        $this->db->from($this->table);
        $this->db->where('username', $userName);
        $this->db->where('access_level', $level);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $q = $query->row();
            $level = $q->access_level;
        }
        return $level;
    } */
}