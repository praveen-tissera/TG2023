<?php

if (!($this->session->userdata('user_detail'))) {

  redirect('/user/login');
} else {
  $user_detail = $this->session->userdata('user_detail');
  
}


?>


<!-- load navigatio resouces -->
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
      // print_r($active_courses); 
      ?>
      
      <?php 
      // print_r($select_trainer);
        if(isset($active_courses)){
          echo form_open('trainer/trainerBatch/2'); 
          
            echo '<label>Select a course</label>';
            
             echo "<select name='selected_course' class='form-control'>";
            foreach ($active_courses as $key_course => $course) {
              // print_r($course);
              echo "<option value='{$course->course_id}'>";
              echo $course->course_name;
              echo "</option>";
            }
            echo "</select>";
            
        }elseif(isset($select_course)){
          echo '<p class="lead">';
          echo 'Selected course: <br>';
          echo '<p class="badge badge-primary">' . $select_course->course_name . '</p>';
          echo '</p>';
        }
     
        ?>
        
        
      
    </div>
    <div class="col-6">
      <?php
      if(isset($active_trainers)){
        
        echo '<label>Select a trainer</label>';
        
         echo "<select name='trainer_id' class='form-control'>";
        foreach ($active_trainers as $key_trainer => $trainer) {
          
          echo "<option value='{$trainer->trainer_id}'>";
          
          echo $trainer->first_name . ' ' . $trainer->last_name;
          echo "</option>";
        }
        echo "</select>";
        
      }else if(isset($select_trainer)){
        echo '<p class="lead">';
        echo 'Selected trainer: <br>';
        echo '<p class="badge badge-primary">' . $select_trainer->first_name . ' ' .  $select_trainer->last_name . '</p>';
        echo '</p>';
      }
   
      ?>
    </div>
    </div>
    <div class="row">
      <div class="col-12">
        
        <?php 
        if(isset($course_batches) && is_array($course_batches)){
         
          echo form_open('trainer/trainerBatch/3'); 
          // print_r($select_trainer);
          echo "<input type='hidden' name='course_id' value='$select_course->course_id'>";
          echo "<input type='hidden' name='trainer_id' value='$select_trainer->trainer_id'>";
          // print_r($course_batches);
          echo '<label>Select a batch</label>';
        
         echo "<table class='table table-dark' >";
          
          foreach ($course_batches as $key => $batch) {
            
            echo "<tr><td>";
            echo "<li style='list-style:none;'>";
                echo '<div class="alert alert-danger" role="alert">';
                //  print_r($batch->trainer_details);
                if(is_object($batch->trainer_details)){
                  // print_r($batch->trainer_details->trainer_detail);
                  echo '<p>Active Trainer Details:</p>';
                  echo "<p>Name: ";
                  echo $batch->trainer_details->trainer_detail->first_name . ' '
 . $batch->trainer_details->trainer_detail->last_name;
                 
                  echo "<br>Trainer ID: ";
                   echo $batch->trainer_details->trainer_detail->trainer_id;
 
                  echo "</p>";
                  
  

         }else{
                  echo "No active trainer found for this batch";
                }
                echo '</div>';
              echo "<input type='radio' name='select_batch' value='{$batch->batch_id}' id='{$batch->batch_id}' >";
              echo "<label class='ml-3' for='{$batch->batch_id}'>";
                echo ' Batch number - ' . $batch->batch_number;
              echo "</label>";
            echo "</li>";
            echo "</td>";
            echo "<td>";
            // print_r($batch);
            echo "Commence date - " . $batch->commence_date . '<br>';
            echo "Description - " . $batch->discription . '<br>';
            echo "</td>";
            echo "</tr>";
          }
        echo "</table>";
        }else if(isset($course_batches)){
          echo '<div class="alert alert-danger" role="alert">';
          echo 'No batches found for this course';
          echo '</div>';
        }

        
        ?>
      </div>
    </div>
    
      <div class="row">
          <div class="col-12">
        <a href="<?php echo base_url('trainer/trainerBatch/1'); ?>" class="my-4 btn btn-dark">Back</a>
          <button type="submit" class="my-4 btn btn-primary">Next</button>
        </div>
      </div>
    
    <?php  echo form_close();?>
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