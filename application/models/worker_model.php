<?php

class worker_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/colombo");
    }
    public function registerworker($data)
    {
        // print_r($data);
        $query = $this->db->select('*')
            ->where('name', $data['name'])
            ->get('worker_tbl');

        // echo $query->num_rows();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            $this->db->insert('worker_tbl', $data);
            return true;
        }
    }
    public function loginCheck($data)
    {
        $condition = "email='{$data['email']}' && password='{$data['password']}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('user_tbl');
        echo $this->db->last_query();
        // return $query->result();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getworkerData()
    {
        $condition = "active='1'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('worker_tbl');
        echo $this->db->last_query();
        return $query->result();
    }

    public function deleteworker($id)
    {
        $condition = "worker_id='{$id}'";
        $this->db->set('active', "0");
        $this->db->where($condition);
        $this->db->update('worker_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function check_if_attendance()
    {
        $currentdate = date('Y-m-d');
        $condition = "date='{$currentdate}' ";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('attendance_tbl');
        echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function attendance()
    {
        $condition = "active='1'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('worker_tbl');
        echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result();;
        }
    }


    public function attendance_submit($data)
    {

        $condition = array('worker_id' => $data['worker_id'], 'date' => $data['date']);
        $this->db->set('status', $data['status']);
        $this->db->where($condition);
        $this->db->update('attendance_tbl');

        echo $this->db->last_query();
        //A diffrent methord must be used check wheather the query worked
        if ($this->db->affected_rows() == 1) {
            return (1);
        } elseif ($this->db->affected_rows() == 0) {
            return (1);
        } else {
            return (0);
        }
    }
    public function attendance_submit_unset($data)
    {
        $this->db->insert('attendance_tbl', $data);
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function getworkerDataByID($id)
    {
        $condition = "worker_id='{$id}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('worker_tbl');
        echo $this->db->last_query();
        // return $query->result();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function updateworker($data)
    {
        $condition = "worker_id  ='{$data['worker_id']}'";
        $this->db->set('name', $data['name']);
        $this->db->set('dob', $data['dob']);
        $this->db->set('emp_status', $data['emp_status']);
        $this->db->set('wage', $data['wage']);
        $this->db->set('EPF', $data['EPF']);
        $this->db->set('EPF_no', $data['EPF_no']);
        $this->db->set('ETF', $data['ETF']);
        $this->db->set('ETF_no', $data['ETF_no']);
        $this->db->set('gender', $data['gender']);
        $this->db->set('education', $data['education']);
        $this->db->set('address', $data['address']);
        $this->db->where($condition);
        $this->db->update('worker_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            return (-1);
        }
    }
    public function for_deletion()
    {
        $condition = "active='0'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('worker_tbl');
        echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result();
        }
    }
    public function perm_deleteworker($id){
        $condition = "worker_id='{$id}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->delete('worker_tbl');
        echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function restore_worker($id)
    {
        $condition = "worker_id='{$id}'";
        $this->db->set('active', "1");
        $this->db->where($condition);
        $this->db->update('worker_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }
}
