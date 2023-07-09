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
    <h2>Trainer Registration</h2>
    <div class="col-12">
      <?php echo form_open('trainer/addNewTrainer'); ?>
      <div class="form-group">
          <label>First Name</label>
          <input type="text" value="<?php echo set_value('firstname'); ?>" class="form-control" name="firstname">

        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" value="<?php echo set_value('lastname'); ?>" class="form-control" name="lastname">

        </div>
        <div class="form-group">
          <label>Birth Date</label>
          <input type="date" value="<?php echo set_value('bdate'); ?>" class="form-control" name="bdate" >

        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" value="<?php echo set_value('email'); ?>" class="form-control" name="email" >

        </div>
        <!-- <div class="form-group">
          <label>Contact Number</label>
          <input type="tel" class="form-control" name="telephone">

        </div> -->
        <div class="form-group">
          <label>Temporary password</label>
          <input type="text" value="<?php echo set_value('password'); ?>" class="form-control" name="password" placeholder="use student NIC number" >

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