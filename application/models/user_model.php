<?php 

class User_model extends CI_Model{

    // method to register user
    public function registerUser($data){
        // print_r($data);
        $query = $this->db->select('*')
                ->where('email',$data['email'])
                ->get('register_tbl');
        
        // echo $query->num_rows();
        if($query->num_rows() == 1){
            return false;
        }else{
            $this->db->insert('register_tbl', $data);
            return true;
        }
        
    }
}