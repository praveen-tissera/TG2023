<?php

class estate_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/colombo");
    }
    public function insert_estate_data($data)
    {
        $currentdate = date('Y-m-d');
        $condition = "date='{$currentdate}' && id='{$data['id']}'  && status='{$data['status']}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('estate_status_tbl');
        if($query->num_rows() == 0){
        $condition = "date='{$currentdate}' && id='{$data['id']}'";
        $query = $this->db->select('*')
            ->where($condition)
            ->get('estate_status_tbl');
        if ($query->num_rows() != 0) {
            $condition =  "date='{$currentdate}' && id='{$data['id']}'";
        $this->db->set('status', $data['status']);
        $this->db->where($condition);
        $this->db->update('estate_status_tbl');
        } else {
            $this->db->insert('estate_status_tbl', $data);
        }
        echo $this->db->last_query();
        if ($this->db->affected_rows() == 1) {
            return (1);
        } else {
            return (0);
        }
    }else{
        return (1);
    }
    }
    public function get_count()
    {
        return $this->db->count_all('estate_status_tbl');
    }
    public function estate_history($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query =  $this->db->get('estate_status_tbl');

        return $query->result();
    }
}
