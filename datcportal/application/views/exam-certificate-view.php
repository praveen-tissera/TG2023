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
          echo form_open('course/examCertificate/2');
          echo "<select class='form-control' name='selectcourse'>";
          // print_r($active_courses);
          foreach ($active_courses as $key => $active_course) {
              echo "<option value='{$active_course->course_id}'>$active_course->course_name</option>";
          }
          echo "</select>";
          
        }elseif (isset($select_course_detail)) {
          echo '<label>Selected course</label> <br>';
            echo "<p class='badge badge-primary'>{$select_course_detail[0]->course_name}</p>";
           
        }
        
      ?>

        </div>
        <?php
          if(isset($active_batches)){
            echo '<div class="col-6">';
            // print_r($active_batches);
            echo form_open('course/examCertificate/3');
            echo "<input type='hidden' name='course_id' value={$select_course_detail[0]->course_id}>";
            echo '<label>Select Batch</label>';
            echo "<select class='form-control' name='selectbatch'>";
            // print_r($active_courses);
             
            foreach ($active_batches as $key => $active_batch) {
                echo "<option value='{$active_batch->batch_id}'>$active_batch->batch_number</option>";
            }
            echo "</select>";
  
          echo '</div>';
          }elseif (isset($select_batch_detail)) {
            // print_r($select_batch_detail);
           
            echo "<input type='hidden' value='{$select_batch_detail->course_id}' name='course_id'>";
            echo "<input type='hidden' value='{$select_batch_detail->batch_id}' name='batch_id'>";
            echo '<div class="col-6">';
              echo '<label>Selected batch number : </label><br>';
              
              echo "<p class='badge badge-primary'>{$select_batch_detail->batch_number}</p>";
            echo "</div>";
          }
        ?>
      
        
  </div>

      <?php
      
        //  print_r($students_detail);
        if(isset($students_detail) &&  $students_detail != 0){
          echo "<div class='row'>";
            echo "<div class='col-12'>";

       
        echo "<table class='table table-striped table-responsive'>";
        echo "<thead><tr>";
          echo "<th>";
            echo "Registration #";
          echo "</th>";
          echo "<th>";
            echo "Student name";
          echo "</th>";
          echo "<th>";
            echo "Student state in batch";
          echo "</th>";
          echo "<th>";
            echo "Student account state";
          echo "</th>";
          echo "<th>";
            echo "Register date";
          echo "</th>";
          echo "<th>";
            echo "Certificate number";
          echo "</th>";
          echo "<th>";
            echo "";
          echo "</th>";
        


        echo "</tr></thead>";
        echo "<tbody>";
        foreach ($students_detail as $key => $student) {
          echo "<tr>";
            echo "<td>";
              echo $student->student_full_details->student_id;
            echo "</td>";
            echo "<td>";
              echo $student->student_full_details->first_name . ' ' .  $student->student_full_details->last_name;
            echo "</td>";
            echo "<td>";
            
           if($student->state == 'active'){
              echo "<span class='badge badge-success'>". $student->state . "</span>";
            }else{
              echo "<span class='badge badge-danger'>". $student->state . "</span>";
            }
          echo "</td>";
          echo "<td>";
            echo $student->student_full_details->state;
          echo "</td>";
          echo "<td>";
            echo $student->added_date;
          echo "</td>";
          echo "<td>";
            echo (empty($student->certificate_no))? 'Not given' : $student->certificate_no;
          echo "</td>";
          echo "<td>";
            echo "<a class='btn btn-link btn-sm' href='" .base_url('course/examCertificate/4/'.$select_batch_detail->course_id.'/'.$select_batch_detail->batch_id.'/'.$student->student_full_details->student_id.'/marks') ."'>Add marks</a> ";
            echo "<a class='btn btn-link btn-sm' href='" .base_url('course/examCertificate/4/'.$select_batch_detail->course_id.'/'.$select_batch_detail->batch_id.'/'.$student->student_full_details->student_id.'/certificate') ."'>Add certificate info</a>";
          echo "</td>";
          echo "</tr>";
        }
        echo "</tbody>";
         
        echo "</table>";
        echo "</div>";
        echo "</div>";
      }
      
     
      ?>
      <?php 
        if(isset($student_marks) && is_array($student_marks)){
          echo '<div class="row">';
            echo '<div class="col-12">';
          // print_r($student_marks);
          echo "<h3 class='mt-4'>".$select_student[0]->first_name . ' '.  $select_student[0]->last_name . " mark sheet</h3>";
          echo "<table class='table table-striped'>"; 
            echo "<thead><tr><td>Subject id</td><td>Subject name</td><td>Subject status</td><td>Student mark</td><td>pass/fail</td><td></td></tr></thead>";

            echo "<tbody>";
            
            foreach ($student_marks as $key => $student) {
             
              
              echo form_open('course/examCertificate/4/'.$select_batch_detail->course_id.'/'.$select_batch_detail->batch_id.'/'.$student_id.'/marks');
              echo "<input type='hidden' name='subjectid' value='{$student->subject_id}'";
              echo "<tr>";
              echo "<td>";
                echo $student->subject_id;
              echo "</td>";
              echo "<td>";
                echo $student->subject_name;
              echo "</td>";
              echo "<td>";
                echo $student->state;
              echo "</td>";
              echo "<td>";
              // print_r($student);
              if($student->student_mark == 'not found'){
                echo "<input type='number' min='0' max='100' name='newmark' placeholder='add marks'>";
              }else{
                echo "<input type='number' min='0' max='100' name='newmark' value='{$student->student_mark[0]->mark}'>";
              }
                
              echo "</td>";
              echo "<td>";
                
                if($student->student_mark == 'not found'){
                  echo "<select name='markstate'>";
                    echo "<option>absent</option>";
                    echo "<option>pass</option>";
                    echo "<option>fail</option>";
                    
                  echo "</select>";
                }else{
                  
                  echo "<select name='markstate'>";
                  echo "<option ";
                  echo ($student->student_mark[0]->state == 'pass') ? 'selected':'';
                  echo  ">pass</option>";
                  echo "<option ";
                  echo ($student->student_mark[0]->state == 'fail') ? 'selected':'';
                  echo  ">fail</option>";
                  echo "<option ";
                  echo ($student->student_mark[0]->state == 'absent') ? 'selected':'';
                  echo  ">absent</option>";
                echo "</select>";
                }
                 
              echo "</td>";
              echo "<td>";
                  echo "<input type='submit' class='btn btn-info btn-sm' value='update'>";
              echo "</td>";
              echo "</tr>";
              echo form_close();
              
            }
            echo "</tbody>";
          echo "</table>";
            echo '</div>';
          echo '</div>';
        }else if(isset($student_batch_certificate)){
          echo '<div class="row">';
            echo '<div class="col-12">';
    
            echo "<h3 class='mt-4'>". $select_student[0]->first_name . ' '.  $select_student[0]->last_name  . " Certificate detail</h3>";
            echo '<div class="alert alert-warning" role="alert">
            Student batch status should be active when adding certificate details.
          </div>';
            echo form_open('course/examCertificate/4/'.$select_batch_detail->course_id.'/'.$select_batch_detail->batch_id.'/'.$student_batch_certificate->student_id.'/certificate');
          echo "<input type='hidden' name='studentid' value='{$student_batch_certificate->student_id}'>";
          echo "<input type='hidden' name='batchid' value='{$student_batch_certificate->batch_id}'>";
            echo '<div class="form-group">';
            echo '<label for="certificate">Valid certificate number</label>';
            if(empty($student_batch_certificate->certificate_no)){
              echo '<input name="certificatenumber" type="text" class="form-control" id="certificate" placeholder="add number entered in the certificate">';
            }else{
              echo '<input type="text" class="form-control" id="certificate" name="certificatenumber" placeholder="add number entered in the certificate" value="' . $student_batch_certificate->certificate_no .'">';
            }
            echo '<button type="submit" class="mt-4 form-group btn btn-info">Update certificate</button>';
          echo '</div>';
          echo '</div>';
          // print_r($student_batch_certificate);

          echo form_close();
        }
      
      ?>
      <div class="row">
      <div class="col-12">
         <a class="btn btn-dark mt-2" href="<?php echo base_url('course/examCertificate')?>">Back</a>
        <button type="submit" class="mt-4 form-group btn btn-primary">Next</button>
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