<?php

class User_model extends CI_Model
{

    // method to register user
    public function registerUser($data)
    {
        $query = $this->db->select('*')
            ->where('email', $data['email'])
            ->get('user_tbl');
        if ($query->num_rows() == 1) {
            return false;
        } else {
            $data['password'] = sha1($data['password']);
            $this->db->insert('user_tbl', $data);
            return true;
        }
    }
    public function loginCheck($data)
    {
        $data['e_password'] = sha1($data['password']);
        $condition = "email='{$data['email']}' && password='{$data['e_password']}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('user_tbl');
        // return $query->result();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserData($data)
    {
        $condition = "email='{$data['email']}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('user_tbl');
        // return $query->result();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getUserDataByID($id)
    {
        $condition = "id='{$id}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('user_tbl');
        // return $query->result();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updateProfile($data)
    {
        $condition = "id  ='{$data['id']}'";
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('address', $data['address']);
        $this->db->where($condition);
        $this->db->update('user_tbl');
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            return (-1);
        }
    }
}
