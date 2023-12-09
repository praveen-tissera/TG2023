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
                        ->get('user_tbl');
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
                        ->get('user_tbl');
        echo $this->db->last_query();
        // return $query->result();
        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getUserDataByID($id){
        $condition = "id='{$id}'";
        $query = $this->db->select('*')
                        ->where($condition)
                        ->get('user_tbl');
        echo $this->db->last_query();
        // return $query->result();
        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function updateProfile($data){
        $condition ="id  ='{$data['id']}'";
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('address', $data['address']);
        $this->db->where($condition);
        $this->db->update('user_tbl');
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
