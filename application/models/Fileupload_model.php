<?php defined('BASEPATH') or exit('No direct script access allowed');
class Fileupload_model extends CI_Model
{
    var $table = 'fileupload';
    var $column_order = array('sale_channel', 'file_name', 'file_type', 'upload_time'); //set column field database for datatable orderable    
    var $column_search = array('sale_channel', 'file_name', 'file_type'); //set column field database for datatable searchable just firstname , lastname , address are searchable     var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_fileupload_query()
    {
        $this->db->select($this->column_order);
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_fileupload_datatables()
    {
        $this->_get_datatables_fileupload_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_record()
    {
        $this->_get_datatables_fileupload_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_record()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function save_upload($saleChannel, $fileType, $csvFile)
    {
        print_r($saleChannel);
        print_r($fileType);
        print_r($csvFile);
        $data = array(
            'sale_channel' => $saleChannel,
            'file_name' => $csvFile,
            'file_type' => $fileType,
        );
        $result = $this->db->insert('fileupload', $data);
        return $result;
    }
}