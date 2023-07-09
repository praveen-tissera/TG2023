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
          echo form_open('attendance/searchAttendance/2');
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
            echo form_open('attendance/searchAttendance/3');
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
            echo '<div class="col-6">';
            // print_r($select_batch_detail);
            echo form_open('attendance/searchAttendance/4');
            echo "<input type='hidden' value='{$select_batch_detail->course_id}' name='course_id'>";
            echo "<input type='hidden' value='{$select_batch_detail->batch_id}' name='batch_id'>";
            
              echo '<label>Selected batch number : </label><br>';
              
              echo "<p class='badge badge-primary'>{$select_batch_detail->batch_number}</p>";
            echo "</div>";
          }
        ?>
      
        
  </div>

      <?php
      
        // print_r();
        if(isset($batch_attendance) &&  $batch_attendance != 0){
          echo "<div class='row'>";
            echo "<div class='col-12'>";

       
        echo "<table class='table table-striped table-responsive'>";
        echo "<tr>";
          echo "<th>";
            echo "Registration #";
          echo "</th>";
          echo "<th>";
            echo "Student name";
          echo "</th>";
          // create heading for th all attendance dates
        foreach ($batch_attendance as $value) {
          echo "<th>";
            echo $value->attend_date;
          echo "</th>";
          
        }


        echo "</tr>";


        // create row for trainer attendance
        if(is_object($batch_trainer_attendance)){
          // print_r($batch_trainer_attendance);
          echo "<tr>";
          echo "<td>";

          echo $batch_trainer_attendance->trainer_id;
          echo "</td>";
          echo "<td>";
          echo $batch_trainer_attendance->trainer_detail->first_name . " " . $batch_trainer_attendance->trainer_detail->last_name;
          echo ' <span class="badge badge-info"> Trainer </span> ';
          echo "</td>";
          foreach ($batch_attendance as $batch_attend_date) {
            $flag =false;
              echo "<td>";
              if(is_array($batch_trainer_attendance->trainer_attendance)){
                foreach ($batch_trainer_attendance->trainer_attendance as $trainerAttendDate) {
                  // echo $stdAttendDate->attend_date;
                  // echo "---";
                  // echo $batch_attend_date->attend_date;
                  // echo "<hr>";
  
                  if($trainerAttendDate->attend_date == $batch_attend_date->attend_date ){
                    
                    // $stdAttendDate->attend_date;
                     echo $trainerAttendDate->status;
                     $flag = true;
                    
                  }
                  
                }
                // if flag is ture means there is a attendace found for the date period
                if(!$flag){
                  echo 'N/A';
                }

                
              }
              else{
                // echo "<td>";
                  echo 'N/A';
                // echo "</td>";
              }
              
              echo "</td>";
          }
          echo "</tr>";
        }



        // create rows for student attendance
        //  print_r($batch_student_attendance);
        foreach ($batch_student_attendance as $studentkey => $stdObj) {
          echo "<tr>";
            echo "<td>";

            echo $stdObj->student_detail->student_id;
            echo "</td>";
            echo "<td>";
            echo $stdObj->student_detail->first_name . " " . $stdObj->student_detail->last_name;
            echo "</td>";
            // loop throung full attendance and search through student attendance array if it contain attendated date
            foreach ($batch_attendance as $batch_attend_date) {
              $flag =false;
              echo "<td>";
              if(is_array($stdObj->student_attendance)){
                foreach ($stdObj->student_attendance as $stdAttendDate) {
                  // echo $stdAttendDate->attend_date;
                  // echo "---";
                  // echo $batch_attend_date->attend_date;
                  // echo "<hr>";
  
                  if($stdAttendDate->attend_date == $batch_attend_date->attend_date ){
                    
                    // $stdAttendDate->attend_date;
                     echo $stdAttendDate->status;
                     $flag = true;
                    
                  }
                  
                }
                // if flag is ture means there is a attendace found for the date period
                if(!$flag){
                  echo 'N/A';
                }

                
              }
              else{
                // echo "<td>";
                  echo 'N/A';
                // echo "</td>";
              }
              
              echo "</td>";
            }


          echo "</tr>";


        }
         
        echo "</table>";
        echo "</div>";
        echo "</div>";
      }
      
     
      ?>
      <div class="row">
      <div class="col-12 mb-4">
         <a class="btn btn-dark mt-2" href="<?php echo base_url('attendance/searchAttendance')?>">Back</a>
         <?php 
          if(isset($batch_attendance)){
            echo '<button type="submit" class="mt-4 form-group btn btn-primary">Next</button>';
          }else if(isset($active_batches) && count($active_batches)>0){
            echo '<button type="submit" class="mt-4 form-group btn btn-primary">Next</button>';
          }else if(isset($active_courses)){
            echo '<button type="submit" class="mt-4 form-group btn btn-primary">Next</button>';
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