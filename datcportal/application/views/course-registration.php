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
      <?php echo form_open('course/addNewCourse'); ?>
      <div class="form-group">
          <label>Course name</label>
          <input type="text" value="<?php echo set_value('coursename'); ?>" class="form-control" name="coursename">

        </div>
        <div class="form-group">
          <label>Course description</label>
          
          <textarea rows="5" cols="20" class="form-control" name="coursediscription"><?php echo set_value('coursediscription'); ?></textarea>

        </div>
        <div class="form-group">
          <label>Course fee</label>
          <input type="text" value="<?php echo set_value('coursefee'); ?>" class="form-control" name="coursefee" >

        </div>
        <div class="form-group">
          <label>Course type</label>
          <select class="form-control" name="coursetype">
            <option value="diploma">Diploma</option>
            <option value="oneday">One Day Training</option>
            <option value="threedays">Three Days Training</option>
          </select>

        </div>


        <button type="submit" class="form-group btn btn-primary">Next</button>
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