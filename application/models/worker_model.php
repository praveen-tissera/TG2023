<?php

class worker_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/colombo");
    }
    public function registerUser($data)
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
        $query = $this->db->get('worker_tbl');
        echo $this->db->last_query();
        return $query->result();
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
        $this->load->model('worker_model');
        $currentdate = date('Y-m-d');
        if ($this->worker_model->check_if_attendance()) {;
            $query = $this->db->get('worker_tbl');
            $workerdata = $query->result();
            print_r($workerdata);
            $condition = "date='{$currentdate}' ";
            $query = $this->db->select('*')
                ->where($condition)
                ->get('attendance_tbl');
            $attendance = $query->result();
            echo $this->db->last_query();
            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        } else {

            $query = $this->db->get('worker_tbl');
            echo $this->db->last_query();
            if ($query->num_rows() == 0) {
                return false;
            } else {
                return $query->result();;
            }
        }
    }

    public function attendance_submit($data)
    {
        $currentdate = date('Y-m-d');
        if ($this->worker_model->check_if_attendance()) {
            foreach ($data as $key => $value) {
                $condition = array('worker_id' => $value->worker_id, 'date' => $currentdate);
                $this->db->set('status', $value->status);
                $this->db->where($condition);
                $this->db->update('attendance_tbl');
            }
        } else {
            $this->db->insert('attendance_tbl', $data);
        }


        echo $this->db->last_query();
        if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            return (1);
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
}
