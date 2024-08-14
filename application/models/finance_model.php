<?php

class finance_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/colombo");
        $this->load->helper('array');
    }

    public function add_expense_type($data)
    {
        $this->db->insert('expense_types_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function get_expense_types()
    {
        $condition = "status='1'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('expense_types_tbl');
        echo ($this->db->last_query());
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    public function get_balance_types()
    {
        $query = $this->db->select('*')
            ->get('current_finance_tbl');
        echo ($this->db->last_query());
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }


    public function add_expense($data)
    {
        $this->db->insert('expense_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function get_bal($id)
    {
        $condition = "id='{$id}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('current_finance_tbl');
        echo ($this->db->last_query());
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            $result = $query->result();
            return $result["0"]->amount;
        }
    }

    public function set_bal($id,$amount)
    {
        $condition = "id  ='{$id}'";
        $this->db->set('amount', $amount);
        $this->db->where($condition);
        $this->db->update('current_finance_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            return (-1);
        }
    }

    public function add_income_type($data)
    {
        $this->db->insert('income_types_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function get_income_types()
    {
        $condition = "status='1'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('income_types_tbl');
        echo ($this->db->last_query());
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }

    public function add_income($data)
    {
        $this->db->insert('income_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    public function tran_history($start_date, $end_date)
    {
        $date = $start_date;
        $result = array();
        echo ($end_date);
        echo ($start_date);
        while ($date <= $end_date) {
            $condition = "date='{$date}'";
            $query = $this->db->select('*')
                ->where($condition)
                ->get('chemical_in_tbl');
            print_r($this->db->last_query());
            $result["in"][$date] = $query->result();

            $condition = "date='{$date}'";
            $query = $this->db->select('*')
                ->where($condition)
                ->get('chemical_out_tbl');
            print_r($this->db->last_query());
            $result["out"][$date] = $query->result();


            $formated_date = date_create($date);
            date_add($formated_date, date_interval_create_from_date_string("1 day"));
            $date = date_format($formated_date, "Y-m-d");
        }
        return $result;
    }
}
