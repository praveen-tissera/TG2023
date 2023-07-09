<?php

if (!($this->session->userdata('user_detail'))) {

  redirect('/user/login');
} else {
  $user_detail = $this->session->userdata('user_detail');
  
}


?>



<?php $this->load->view('header'); ?>
<?php $this->load->view('top-navigation'); ?>
<?php $this->load->view('staff-navigation'); ?>



<br>

<div class="container">
  <div class="row">
    <div class="col-12">
    <?php

    if (isset($error_message_display)) {
      echo '<div class="alert alert-danger" role="alert">';
      echo $error_message_display;
      echo '</div>';
    }
    if (isset($success_message_display)) {
      echo '<div class="alert alert-success" role="alert">';
      echo $success_message_display;
      echo '</div>';
    }
    // if trainer login and could not found any batches assigne to his
    if((isset($active_batches) && count($active_batches)==0)){
      echo '<div class="alert alert-danger" role="alert">';
      echo "No active batch found for this profile";
      echo '</div>';
    }
    ?>
    </div>
  </div>
    <?php 
    // print_r($studentManagement);
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          

          
  }
    
    ?>
    <div class="row">
    
    
      

      <div class="col-6">
          
      <?php 
        if(isset($active_courses)){
          echo '<label>Course name</label>';
          echo form_open('attendance/newAttendanceRegistration/2');
          echo "<select class='form-control' name='selectcourse'>";
          // print_r($active_courses);
          foreach ($active_courses as $key => $active_course) {
              echo "<option value='{$active_course->course_id}'>$active_course->course_name</option>";
          }
          echo "</select>";
          
        }elseif (isset($select_course_detail)) {
          echo '<label>Selected course</label><br>';
            echo "<p class='badge badge-primary'>{$select_course_detail[0]->course_name}</p>";
           
        }
        
      ?>

        </div>
        <?php
          if(isset($active_batches)){
            echo '<div class="col-6">';
            // print_r($active_batches);
            echo form_open('attendance/newAttendanceRegistration/3');
            echo "<input type='hidden' name='course_id' value={$select_course_detail[0]->course_id}>";
            echo '<label>Select a batch</label>';
            echo "<select class='form-control' name='selectbatch'>";
            // print_r($active_courses);
              
            foreach ($active_batches as $key => $active_batch) {
                echo "<option value='{$active_batch->batch_id}'>$active_batch->batch_number</option>";
            }
            echo "</select>";
  
          echo '</div>';
          }elseif (isset($select_batch_detail)) {
            // print_r($select_batch_detail);
            echo form_open('attendance/newAttendanceRegistration/4');
            echo "<input type='hidden' value='{$select_batch_detail->course_id}' name='course_id'>";
            echo "<input type='hidden' value='{$select_batch_detail->batch_id}' name='batch_id'>";
            echo '<div class="col-12">';
              echo '<label>Selected batch number : </label><br>';
              
              echo "<p class='badge badge-primary'>{$select_batch_detail->batch_number}</p>";
            echo "</div>";
          }
        ?>
      
        
  </div>

      <?php
      
        // print_r($student_in_batch_obj);
        if(isset($student_in_batch_obj) &&  $student_in_batch_obj != 0){
          echo "<div class='row'>";
            echo "<div class='col-12'>";

        $datetime = new DateTime($start_date);
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>";
          echo "Student and trainer name";
        echo "</th>";
        for($i=1;$i<=7;$i++){
            echo "<th>";
            
            echo $datetime->format('Y-m-d');
            $datetime->modify('+1 day');
            echo "</th>";
        }


        echo "</tr>";

          if(is_object($trainer_in_batch_obj)){
            // print_r($trainer_in_batch_obj);
            echo "<tr>";
            echo "<td>";
            // print_r($student);
              echo $trainer_in_batch_obj->trainer_detail->first_name . ' ' . $trainer_in_batch_obj->trainer_detail->last_name;
              echo " <span class='badge badge-info'> Trainer </span>";
            echo "</td>";
            $datetime = new DateTime($start_date);
              
            // print_r($value);
            for($i=1;$i<=7;$i++){
             
              $found_flag = false;
              if(is_array($trainer_in_batch_obj->trainer_attendance)){

                foreach ($trainer_in_batch_obj->trainer_attendance as $key => $value) {
                  if($datetime->format('Y-m-d') == $value->attend_date){
                    // found attendance for the current date
                    $found_flag = true;
                    echo "<td>";
                      echo "<select name='t_{$trainer_in_batch_obj->trainer_id}_$i'>";
                      if($trainer_in_batch_obj->trainer_attendance->status == 'na'){
                        echo "<option selected value='na'>N/A</option>";
                        echo "<option value='0'>0</option>";
                        echo "<option value='1'>1</option>";
                      }elseif($value->status == '0'){
                        echo "<option value='na'>N/A</option>";
                        echo "<option selected value='0'>0</option>";
                        echo "<option value='1'>1</option>";
                      }elseif($value->status == '1'){
                        echo "<option value='na'>N/A</option>";
                        echo "<option value='0'>0</option>";
                        echo "<option selected value='1'>1</option>";
                      }
                     
                        
                       
                      echo "</select>";
                    echo '</td>';
                  }
                }


               
              }
              if(!$found_flag){
                echo "<td>";
                echo "<select name='t_{$trainer_in_batch_obj->trainer_id}_$i'>";
                echo "<option value='na'>N/A</option>";
                  echo "<option value='0'>0</option>";
                  echo "<option value='1'>1</option>";
                echo "</select>";
              echo '</td>';
              }
              $datetime->modify('+1 day');
            }
          }

          foreach ($student_in_batch_obj as $key => $student) {
         echo "<tr>";
            echo "<td>";
            // print_r($student);
              echo $student->student_detail->first_name . ' ' . $student->student_detail->last_name;
            echo "</td>";
            
              // print_r($student->student_attendance);
              $datetime = new DateTime($start_date);
              
                // print_r($value);
                for($i=1;$i<=7;$i++){
                 
                  $found_flag = false;
                  if(is_array($student->student_attendance)){

                    foreach ($student->student_attendance as $key => $value) {


                      if($datetime->format('Y-m-d') == $value->attend_date){
                        // found attendance for the current date
                        $found_flag = true;
                        echo "<td>";
                          echo "<select name='{$student->student_id}_$i'>";
                          if($value->status == 'na'){
                            echo "<option selected value='na'>N/A</option>";
                            echo "<option value='0'>0</option>";
                            echo "<option value='1'>1</option>";
                          }elseif($value->status == '0'){
                            echo "<option value='na'>N/A</option>";
                            echo "<option selected value='0'>0</option>";
                            echo "<option value='1'>1</option>";
                          }elseif($value->status == '1'){
                            echo "<option value='na'>N/A</option>";
                            echo "<option value='0'>0</option>";
                            echo "<option selected value='1'>1</option>";
                          }
                         
                            
                           
                          echo "</select>";
                        echo '</td>';
                      }
                    }
                  }
                  


                if(!$found_flag){
                  echo "<td>";
                  echo "<select name='{$student->student_id}_$i'>";
                  echo "<option value='na'>N/A</option>";
                    echo "<option value='0'>0</option>";
                    echo "<option value='1'>1</option>";
                  echo "</select>";
                echo '</td>';
                }
                $datetime->modify('+1 day');
              }
             
            
         echo "</tr>";
          }
        echo "</table>";
        echo "</div>";
        echo "</div>";
      }
      
     
      ?>
      <div class="row">
      <div class="col-12">
         <a class="btn btn-dark my-4" href="<?php echo base_url('attendance/newAttendanceRegistration')?>">Back</a>
         <?php 
          if(isset($error_message_display) || (isset($active_batches) && count($active_batches)==0)){
        
          }else{
            echo '<button type="submit" class="my-2 form-group btn btn-primary">Next</button>';
          }
         ?>
        
       </div>

        
      <?php  echo form_close();?>
      </div>
    </div>
    
 
  
 



</div>






<?php $this->load->view('footer'); ?>
<script>
  $(document).ready(function(){
    $('#due-date').hide();
    $('#pay_mode').on('change',function(){
      var installment = $(this).val();
      if(installment == '1st installment'){
        $('#due-date').show();
      }else{
        $('#due-date').hide();
      }
    });
  });
</script>