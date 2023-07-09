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
    
    <div class="col-12">
    <?php echo form_open('course/editbatch/0/2'); ?>
    <h2>Batch edit</h2>
    
      
        <?php 
        
        // print_r($course_data);
        // echo '<hr>';
        // print_r($batch_data);
        // echo '<hr>';
        // print_r($trainer_data);
        // echo '<hr>';
        // print_r($trainers);
        
        if(isset($course_data) && isset($batch_data) && isset($trainer_data) && isset($trainers)){
          echo "<input type='hidden' name='courseid' value='{$course_data[0]->course_id}'>";

          echo "<input type='hidden' name='batchid' value='{$batch_data[0]->batch_id}'>";
          ?>

        <div class="form-group">
          <label for="corusename">Course name</label>
          <input type="text" class="form-control" id="corusename" value="<?php echo $course_data[0]->course_name ?>" disabled>
        </div>

        <div class="form-group">
          <label for="batch">Batch number</label>
          <input type="text" name="batchnumber" class="form-control" id="batch" value="<?php echo $batch_data[0]->batch_number ?>">
        </div>

        <div class="form-group">
          <label for="cdate">Commence date</label>
          <input type="date" name="commencedate" class="form-control" id="cdate" value="<?php echo $batch_data[0]->commence_date ?>" >
        </div>

        <div class="form-group">
          <label for="tclosedate">Tentetive close date</label>
          <input type="date" name="tentetiveclosedate" class="form-control" id="tclosedate" value="<?php echo $batch_data[0]->tentitive_close_date ?>" >
        </div>

        <div class="form-group">
          <label for="completedate">Completed date</label>
          <input type="date" name="completedate" class="form-control" id="completedate" value="<?php echo $batch_data[0]->close_date ?>" >
        </div>

        <div class="form-group">
          <label for="completedate">Trainer</label>
          <!-- <input type="date" name="completedate" class="form-control" id="completedate" value="<?php echo $batch_data[0]->close_date ?>" > -->
          <select class="form-control"  name="trainer">
          <?php 

            foreach ($trainers as $key => $trainer) {
              if($trainer->trainer_id == $trainer_data->trainer_id){
                echo "<option selected value='{$trainer->trainer_id}'>{$trainer->first_name} {$trainer->last_name}</option>";
              }else{
                echo "<option value='{$trainer->trainer_id}'>{$trainer->first_name} {$trainer->last_name}</option>";
              }
              
             
            
            }
            
          ?>
          </select>
        </div>

        <div class="form-group">
          <label for="description">Batch description</label>
          
          <textarea class="form-control" name="description" id="description" cols="30" rows="5"><?php echo $batch_data[0]->discription ?></textarea>
        </div>

        

        <div class="form-group">
          <select class="form-control"  name="batchstate">
            <option <?php echo  ($batch_data[0]->state == 'active') ? 'selected' : '' ?> value="active">Active</option>
            <option <?php echo ($batch_data[0]->state == 'complete') ? 'selected' : '' ?> value="complete" value="complete">Complete</option>
            <option <?php echo ($batch_data[0]->state == 'inactive') ? 'selected' : '' ?> value="inactive" value="inactive">Inactive</option>
          </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update">
        </div>
        <?php 
        }
        ?>
        
      <?php echo form_close(); ?>
 
  </div>
    </div>
    <div class="row">
    <div class="col-12">
      
      
      <?php 

      
      ?>



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