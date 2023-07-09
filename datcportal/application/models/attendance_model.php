<?php 
class Attendance_model extends CI_Model
{
  
    /**
     * get students details who are registered to a batch
     */
    public function get_students_by_batch_id($batchid){
        $this->load->model('User_model', 'userModel');
        $condition = "batch_id =" . "'" . $batchid . "'";
        $this->db->select('*');
        $this->db->from('student_batch_map_table');
        $this->db->where($condition);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){

            $student_obj = $query->result();
            foreach ($student_obj as $key => $value) {
               $student_info =  $this->userModel->student_detail_byid($value->student_id)[0];
                $student_obj[$key]->student_detail = $student_info;


                $attendance = $this->read_student_batchwise_attendance($batchid,$value->student_id);
                $student_obj[$key]->student_attendance = $attendance;

                
            }
            return $student_obj;
        }else{
            return(0);
        }
    }

    /**
     * get students details who are registered to a batch
     */
    public function get_trainer_by_batch_id($batchid){
        
        $this->load->model('User_model', 'userModel');


       $active_trainer =  $this->userModel->trainer_map_to_batch($batchid);
    //    print_r($active_trainer);
        if(is_object($active_trainer)){
            $active_trainer->trainer_attendance = $this->read_trainer_batchwise_attendance($batchid,$active_trainer->trainer_id);
            return $active_trainer;
        }else{
            return(0);
        }
        




        // $condition = "batch_id =" . "'" . $batchid . "' AND state = 'active'";
        // $this->db->select('*');
        // $this->db->from('trainer_batch_map_table');
        // $this->db->where($condition);
        
        // $query = $this->db->get();
        // if($query->num_rows() > 0){

        //     $student_obj = $query->result();
        //     foreach ($student_obj as $key => $value) {
        //        $student_info =  $this->userModel->student_detail_byid($value->student_id)[0];
        //         $student_obj[$key]->student_detail = $student_info;


        //         $attendance = $this->read_student_batchwise_attendance($batchid,$value->student_id);
        //         $student_obj[$key]->student_attendance = $attendance;

                
        //     }
        //     return $student_obj;
        // }else{
        //     return(0);
        // }
    }






    /**
     * add or update student attendance
     */
    public function add_new_attendance($data)
    {
        //  print_r($data);

        $condition = "student_id =" . "'" . $data['student_id'] . "' && batch_id = '" . $data['batch_id'] . "' && attend_date = '" . $data['attend_date'] . "'";
        $this->db->select('*');
        $this->db->from('student_attendance_table');
        $this->db->where($condition);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        // echo "<hr>";
        if($query->num_rows() > 0){
            
            $condition ="student_id =" . "'" .  $data['student_id'] . "' AND batch_id=" . "'" . $data['batch_id'] . "' && attend_date = '" . $data['attend_date'] . "'";
            $this->db->set('status', $data['status']);
            $this->db->where($condition);
            
            $this->db->update('student_attendance_table');
            // echo $this->db->last_query();
            
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            }


        }else{
            
            $this->db->insert('student_attendance_table', $data);
            //  echo $this->db->last_query();
             echo "<br>";
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            }
        }

       
       
    }

    /**
     * add or update trainer attendance
     */
    public function trainer_add_new_attendance($data)
    {
        //  print_r($data);

        $condition = "trainer_id =" . "'" . $data['trainer_id'] . "' && batch_id = '" . $data['batch_id'] . "' && attend_date = '" . $data['attend_date'] . "'";
        $this->db->select('*');
        $this->db->from('trainer_attendance_table');
        $this->db->where($condition);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        // echo "<hr>";
        if($query->num_rows() > 0){
            
            $condition ="trainer_id =" . "'" .  $data['trainer_id'] . "' AND batch_id=" . "'" . $data['batch_id'] . "' && attend_date = '" . $data['attend_date'] . "'";
            $this->db->set('status', $data['status']);
            $this->db->where($condition);
            
            $this->db->update('trainer_attendance_table');
            // echo $this->db->last_query();
            
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            }


        }else{
            
            $this->db->insert('trainer_attendance_table', $data);
            //  echo $this->db->last_query();
             echo "<br>";
            if ($this->db->affected_rows() > 0) {
                return(1);
            }else{
                return(0);
            }
        }

       
       
    }

    
    public function read_batchwise_attendance($batch_id){
        $condition = "batch_id =" . "'" . $batch_id . "'";
        $this->db->distinct();
        $this->db->select('attend_date');
        $this->db->from('student_attendance_table');
        $this->db->where($condition);
        $this->db->order_by("attend_date","ASC");
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function read_student_batchwise_attendance($batch_id,$student_id){
        $condition = "batch_id =" . "'" . $batch_id . "' AND student_id = '" . $student_id . "'";
        // $this->db->distinct('attend_date');
        $this->db->select('attend_date,status');
        $this->db->from('student_attendance_table');
        $this->db->where($condition);
        $this->db->order_by("attend_date","ASC");
        
        $query = $this->db->get();
        // echo 'last query' . $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function read_trainer_batchwise_attendance($batch_id,$trainer_id){
        $condition = "batch_id =" . "'" . $batch_id . "' AND trainer_id = '" . $trainer_id . "'";
        // $this->db->distinct('attend_date');
        $this->db->select('attend_date,status');
        $this->db->from('trainer_attendance_table');
        $this->db->where($condition);
        $this->db->order_by("attend_date","ASC");
        
        $query = $this->db->get();
        // echo 'last query' . $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return (0);
        }
    }




   
}