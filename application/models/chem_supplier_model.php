<?php

class chem_supplier_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/colombo");
        $this->load->helper('array');
    }

    public function get_suppliers()
    {
        $condition = "status='1'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('supplier_tbl');
        echo ($this->db->last_query());
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function get_Supplier_Data_By_ID($id)
    {
        $condition = "supplier_id='{$id}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('supplier_tbl');
        echo $this->db->last_query();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function add_supplier($data)
    {
        $this->db->insert('supplier_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function edit_supplier($data)
    {
        $condition = "supplier_id  ='{$data['supplier_id']}'";
        $this->db->set('name', $data['name']);
        $this->db->set('address', $data['address']);
        $this->db->where($condition);
        $this->db->update('supplier_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            return (-1);
        }
    }
    public function delete_supplier($id)
    {
        $condition = "supplier_id  ='{$id}'";
        $this->db->set('status', "0");
        $this->db->where($condition);
        $this->db->update('supplier_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }
}
