<?php 
class Search_model extends CI_Model
{
    public function search_student($data){
        // print_r($data);
        if($data['type'] == 1 ){
            $result = $this->db->like('first_name', $data['search-text'])
            ->or_like('last_name', $data['search-text'])
            ->get('student_table');
        }else if($data['type'] == 2 ){
            $result = $this->db->like('student_id', $data['search-text'])->get('student_table');
        }else if($data['type'] == 3 ){
            $result = $this->db->like('email', $data['search-text'])->get('student_table');
        }
        
        if ($result->num_rows() > 0) {
            //has at least one record with booking or not
            return $result->result();
        } 
        else {
            return(0);
        }
    
    }
    /**
     * search trainer
     */
    public function search_trainer($data){
        // print_r($data);
        if($data['type'] == 1 ){
            $result = $this->db->like('first_name', $data['search-text'])
            ->or_like('last_name', $data['search-text'])
            ->get('trainer_table');
        }else if($data['type'] == 2 ){
            $result = $this->db->like('trainer_id', $data['search-text'])->get('trainer_table');
        }else if($data['type'] == 3 ){
            $result = $this->db->like('email', $data['search-text'])->get('trainer_table');
        }
        
        if ($result->num_rows() > 0) {
            //has at least one record with booking or not
            return $result->result();
        } 
        else {
            return(0);
        }
    
    }
    /**
     * search staff
     */
    public function search_staff($data){
        // print_r($data);
        if($data['type'] == 1 ){
            $result = $this->db->like('staff_name', $data['search-text'])
            ->get('staff_table');
        }else if($data['type'] == 2 ){
            $result = $this->db->like('staff_id', $data['search-text'])->get('staff_table');
        }else if($data['type'] == 3 ){
            $result = $this->db->like('email', $data['search-text'])->get('staff_table');
        }
        
        if ($result->num_rows() > 0) {
            //has at least one record with booking or not
            return $result->result();
        } 
        else {
            return(0);
        }
    
    }
    public function search_course($data){
        // print_r($data);
        if($data['type'] == 1 ){
            $result = $this->db->like('course_name', $data['search-text'])
            ->get('course_table');
        }else if($data['type'] == 2 ){
            $result = $this->db->like('course_description', $data['search-text'])->get('course_table');
        }else if($data['type'] == 3 ){
            $result = $this->db->like('course_type', $data['search-text'])->get('course_table');
        }
        
        if ($result->num_rows() > 0) {
            //has at least one record with booking or not
            return $result->result();
        } 
        else {
            return(0);
        }
    
    }
}