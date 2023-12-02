<?php 

class Product_model extends CI_Model{

    // method to register user
    public function addProduct($data){
        print_r($data);
        $this->db->insert('product_tbl', $data);
        return true;
        
        
    }
    public function get_count() {
        return $this->db->count_all('product_tbl');
    }
    // public function getAllProducts(){
    //     $query = $this->db->get('product_tbl');
    //     // echo $this->db->last_query();
    //     if($query->num_rows() > 0){
    //         return $query->result();
    //     }else{
    //         return false;
    //     }
        
        
        
    // }
    public function getAllProducts($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('product_tbl');

        return $query->result();
    }



    public function updateProfile($data){
        $condition ="id  ='{$data['id']}'";
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('address', $data['address']);
        $this->db->where($condition);
        $this->db->update('register_tbl');
         echo $this->db->last_query();
        if($this->db->affected_rows() == 1){
            return(1);
        }else if($this->db->affected_rows() == 0){
            return(0);
        }else{
            return(-1);
        }
    }
}
