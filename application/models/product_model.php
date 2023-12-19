<?php

class product_model extends CI_Model
{

    public function read_product_data($title)
    {

        $condition = "title =" . "'" . $title . "'";
        $this->db->select('*');
        $this->db->from('product_tbl');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function get_count()
    {
        return $this->db->count_all('product_tbl');
    }
    public function getAllProducts($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query =  $this->db->get('product_tbl');

        return $query->result();
    }
}
