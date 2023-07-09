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
    <div class="col-12">
   <?php
    if(validation_errors() ){
      echo '<div class="alert alert-danger" role="alert">';
        echo validation_errors();
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
      <?php echo form_open('course/addNewBatch'); ?>

      <div class="form-group">
          <label>Course name</label>
      <?php 
        if(isset($active_courses)){
          echo "<select class='form-control' name='selectcourse'>";
          // print_r($active_courses);
          foreach ($active_courses as $key => $active_course) {
              echo "<option value='{$active_course->course_id}'>$active_course->course_name</option>";
          }
          
        }
        echo "</select>";
      ?>

        </div>
        
        <div class="form-group">
          <label>Batch number</label>
          <input type="text" value="<?php echo set_value('batchnumber'); ?>" class="form-control" name="batchnumber" min="1" >

        </div>
        <div class="form-group">
          <label>Commence date</label>
          <input type="date" value="<?php echo set_value('commencedate'); ?>" class="form-control" name="commencedate" >

        </div>
        <div class="form-group">
          <label>Tentitive closing date</label>
          <input type="date" value="<?php echo set_value('tentativeclosedate'); ?>" class="form-control" name="tentativeclosedate" >

        </div>
        <div class="form-group">
          <label>Batch description</label>
          <textarea class="form-control" name="discription" cols="30" rows="10"><?php echo set_value('discription'); ?></textarea>

        </div>
       

        <button type="submit" class="form-group btn btn-primary">Submit</button>
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