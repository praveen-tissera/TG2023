<?php

class estate_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/colombo");
        $this->load->helper('array');
    }
    public function insert_estate_data($data)
    {
        $currentdate = date('Y-m-d');
        //check if the data supplied is different from the data already in the database
        $condition = "date='{$currentdate}' && id='{$data['id']}'  && status='{$data['status']}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('estate_status_tbl');
        if ($query->num_rows() == 0) {
            //check if any data has been submitted for that day
            $condition = "date='{$currentdate}' && id='{$data['id']}'";
            $query = $this->db->select('*')
                ->where($condition)
                ->get('estate_status_tbl');
            if ($query->num_rows() != 0) {
                //if data exists, update the record
                $condition =  "date='{$currentdate}' && id='{$data['id']}'";
                $this->db->set('status', $data['status'], 'colour', $data['colour']);
                $this->db->where($condition);
                $this->db->update('estate_status_tbl');
            } else {
                //if data does not exist, insert a new record for that day
                $this->db->insert('estate_status_tbl', $data);
            }
            if ($this->db->affected_rows() == 1) {
                return (1);
            } else {
                return (0);
            }
        } else {
            return (1);
        }
    }
    public function get_count()
    {
        return $this->db->count_all('estate_status_tbl');
    }
    public function estate_history($start_date, $end_date)
    {
        $date = $start_date;
        $result = array();
        while ($date <= $end_date) {
            $condition = "date='{$date}'";
            $query = $this->db->select('*')
                ->where($condition)
                ->get('estate_status_tbl');
            $result[$date] = $query->result();
            $formated_date = date_create($date);
            date_add($formated_date, date_interval_create_from_date_string("1 day"));
            $date = date_format($formated_date, "Y-m-d");
        }
        return $result;
    }
    public function ODR_estate($date)
    {
        $condition = "date='{$date}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('estate_status_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function insert_weather_data($data)
    {

        $this->db->insert('weather_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }
    public function check_weather_data($date)
    {
        $condition = "date='{$date}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('weather_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_weather($date)
    {
        $condition = "date='{$date}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('weather_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_attendance($date)
    {
        $condition = "date='{$date}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('attendance_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_worker()
    {
        $condition = "active='1'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('worker_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_fin_types()
    {
        $query = $this->db->select('*')
            ->get('income_types_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $data["in"] = $query->result();
        }
        $query = $this->db->select('*')
            ->get('expense_types_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $data["out"] = $query->result();
        }
        return ($data);
    }
    public function ODR_fin_info($date)
    {
        $condition = "date='{$date}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('income_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $data["in"] = $query->result();
        }
        $query = $this->db->select('*')
            ->where($condition)
            ->get('expense_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $data["out"] = $query->result();
        }
        return ($data);
    }
    public function ODR_fin_current()
    {
        $query = $this->db->select('*')
            ->get('current_finance_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_suppliers()
    {
        $query = $this->db->select('*')
            ->get('supplier_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_chem_types()
    {
        $query = $this->db->select('*')
            ->get('chemical_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function ODR_chem_info($date)
    {
        $condition = "date='{$date}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('chemical_in_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $data["in"] = $query->result();
        }
        $query = $this->db->select('*')
            ->where($condition)
            ->get('chemical_out_tbl');
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $data["out"] = $query->result();
        }
        return ($data);
    }
}
