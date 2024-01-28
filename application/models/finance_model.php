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

    public function edit_chemical($data)
    {
        $condition = "chem_id  ='{$data['chem_id']}'";
        $this->db->set('name', $data['name']);
        $this->db->set('type', $data['type']);
        $this->db->set('description', $data['description']);
        $this->db->where($condition);
        $this->db->update('chemical_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            return (-1);
        }
    }
    public function delete_chemical($id)
    {
        $condition = "chem_id  ='{$id}'";
        $this->db->set('status', "0");
        $this->db->where($condition);
        $this->db->update('chemical_tbl');
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }
    public function update_current_chemicals($data, $supplier_id)
    {
        $condition = "chem_id = {$data['chem_id']}";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('current_chemical_tbl');
        if ($query->num_rows() == 0) {
            $this->db->insert('current_chemical_tbl', $data);
            if ($this->db->affected_rows() == 0) {
                return (0);
            }
        } else {
            $query_result = $query->result();
            print_r($query_result);
            echo $amount = $query_result[0]->amount + $data['amount'];
            $condition = "chem_id= {$data['chem_id']}";
            $this->db->set('amount', $amount);
            $this->db->set('cost', $data['cost']);
            $this->db->where($condition);
            $this->db->update('current_chemical_tbl');
            echo $this->db->last_query();
            if ($this->db->affected_rows() == 0) {
                return (0);
            }
        }
        $condition = "chem_id = '{$data['chem_id']}' && supplier_id = '$supplier_id' ";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('chem_supplier_tbl');
        if ($query->num_rows() == 0) {
            $chem_supp = array(
                "chem_id" => $data['chem_id'],
                "supplier_id" => $supplier_id
            );
            $this->db->insert('chem_supplier_tbl', $chem_supp);
            if ($this->db->affected_rows() == 0) {
                return (0);
            } else {
                return (1);
            }
        } else {
            return (1);
        }
    }
    public function chemicals_in($data)
    {
        $this->db->insert('chemical_in_tbl', $data);
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }
    public function chemicals_out($data)
    {
        $this->db->insert('chemical_out_tbl', $data);
        if ($this->db->affected_rows() == 0) {
            return (0);
        } else {
            $condition = "chem_id = {$data['chem_id']}";
            $query = $this->db->select('*')
                ->where($condition)
                ->get('current_chemical_tbl');
            $query_result = $query->result();
            $amount = $query_result[0]->amount - $data['amount'];
            $condition = "chem_id= {$data['chem_id']}";
            $this->db->set('amount', $amount);
            $this->db->where($condition);
            $this->db->update('current_chemical_tbl');
            echo $this->db->last_query();
            if ($this->db->affected_rows() == 0) {
                return (0);
            } else {
                return (1);
            }
        }
    }
    public function chemical_history($start_date, $end_date)
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
