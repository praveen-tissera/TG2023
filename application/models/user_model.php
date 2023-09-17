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
    public function loginCheck($data){
        $condition = "email='{$data['email']}' && password='{$data['password']}'";
        $query = $this->db->select('*')
                        ->where($condition)
                        ->get('register_tbl');
        echo $this->db->last_query();
        // return $query->result();
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getUserData($data){
        $condition = "email='{$data['email']}'";
        $query = $this->db->select('*')
                        ->where($condition)
                        ->get('register_tbl');
        echo $this->db->last_query();
        // return $query->result();
        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }
}
