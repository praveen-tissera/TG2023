<?php
class UserModle extends CI_Model
{
public function registerUser($data){
        $this->db->insert('register_tbl', $data);
}
}
