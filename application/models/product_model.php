<?php

class Product_model extends CI_Model
{
    // method to register product
    public function addproduct($data_product)
    {
        // print_r($data);
        $query = $this->db->select('*')
            ->where('title', $data_product['title'])
            ->get('product_table');

        // echo $query->num_rows();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            $this->db->insert('product_table', $data_product);
            return true;
        }
    }

    public function getMarks(){
        $query = $this->db->get('student_marks');

        return $query->result();
    }
}
