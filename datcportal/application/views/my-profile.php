<?php

if (!($this->session->userdata('user_detail'))) {

  redirect('/user/login');
} else {
  $user_detail = $this->session->userdata('user_detail');
  
}


?>



<?php $this->load->view('header'); ?>

<style>
.pass_show{position: relative} 

.pass_show .ptxt { 

position: absolute; 

top: 50%; 

right: 40px; 

z-index: 1; 

color: #f36c01; 

margin-top: -10px; 

cursor: pointer; 

transition: .3s ease all; 

} 

.pass_show .ptxt:hover{color: #333333;} 

</style>
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
    
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          

          
  }
    
    ?>
    <div class="row">

    <div class="col-12">
    
    </div>
    </div>
    <div class="row">
    <div class="col-12">
      <h2>Profile Details</h2>
      <!-- tab panel -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">My Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#password" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
  </li>
  <!-- <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#notification" role="tab" aria-controls="contact" aria-selected="false">Notification</a>
  </li> -->
</ul>
<!-- tab conent -->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile">
    <?php
    echo '<pre>';
    // print_r($profile);
    echo '</pre>';
    ?>
  
  <?php 
    if($profile->user_role == 'student'){ 
      echo form_open("user/profileUpdate/profile/$profile->user_role");
      ?>
    <div class="form-group row pl-2">
      <label for="regnumber" class="col-sm-2 col-form-label">Registration number</label>
      <div class="col-sm-10">
         <input type="text" name="regnumber" readonly class="form-control-plaintext" id="regnumber" value="<?php echo sprintf("%05d", $profile->student_id); ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="fname" class="col-sm-2 col-form-label">First name</label>
      <div class="col-sm-10">
        <input type="text" name="fname" readonly class="form-control" id="fname" value="<?php echo $profile->first_name; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="lname" class="col-sm-2 col-form-label">Last name</label>
      <div class="col-sm-10">
        <input type="text" name="lname" readonly class="form-control" id="lname" value="<?php echo $profile->last_name; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $profile->email; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
      <div class="col-sm-10">
        <input type="date" name="bdate" readonly class="form-control" id="bdate" value="<?php echo $profile->birth_date; ?>">
      </div>
    </div>
    
    <div class="form-group row pl-2">
      <label for="telephone" class="col-sm-2 col-form-label">Contact number</label>
      <div class="col-sm-10">
        <input type="text" name="telephone" readonly class="form-control" id="telephone" value="<?php echo $profile->telephone; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="state" class="col-sm-2 col-form-label">Profile state</label>
      <div class="col-sm-10">
        <input type="text" name="state" readonly class="form-control-plaintext" id="state" value="<?php echo $profile->state; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="regdate" class="col-sm-2 col-form-label">Register date</label>
      <div class="col-sm-10">
        <input type="text" name="regdate" readonly class="form-control-plaintext" id="regdate" value="<?php echo $profile->register_date; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="role" class="col-sm-2 col-form-label">User role</label>
      <div class="col-sm-10">
        <input type="text" name="role" readonly class="form-control-plaintext" id="role" value="<?php echo $profile->user_role; ?>">
      </div>
    </div>
      
    <?php }
    else if($profile->user_role == 'trainer'){ 
      echo form_open("user/profileUpdate/profile/$profile->user_role");
      ?>
      echo "trainer";
      <div class="form-group row pl-2">
      <label for="regnumber" class="col-sm-2 col-form-label">Registration number</label>
      <div class="col-sm-10">
        <input type="text" name="regnumber" readonly class="form-control-plaintext" id="regnumber" value="<?php echo sprintf("%05d", $profile->trainer_id); ?>">
        
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="fname" class="col-sm-2 col-form-label">First name</label>
      <div class="col-sm-10">
        <input type="text" name="fname" readonly class="form-control" id="fname" value="<?php echo $profile->first_name; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="lname" class="col-sm-2 col-form-label">Last name</label>
      <div class="col-sm-10">
        <input type="text" name="lname" readonly class="form-control" id="lname" value="<?php echo $profile->last_name; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $profile->email; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
      <div class="col-sm-10">
        <input type="date" name="bdate" readonly class="form-control" id="bdate" value="<?php echo $profile->birth_date; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="state" class="col-sm-2 col-form-label">Profile state</label>
      <div class="col-sm-10">
        <input type="text" name="state" readonly class="form-control-plaintext" id="state" value="<?php echo $profile->state; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="regdate" class="col-sm-2 col-form-label">Register date</label>
      <div class="col-sm-10">
        <input type="text" name="regdate" readonly class="form-control-plaintext" id="regdate" value="<?php echo $profile->register_date; ?>">
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="role" class="col-sm-2 col-form-label">User role</label>
      <div class="col-sm-10">
        <input type="text" name="role" readonly class="form-control-plaintext" id="role" value="<?php echo $profile->user_role; ?>">
      </div>
    </div>
    
    <?php }

    else if($profile->user_role == 'admin' || $profile->user_role =='coordinator'){
      echo form_open("user/profileUpdate/profile/$profile->user_role");
      // echo "admin";
      ?>
      <div class="form-group row pl-2">
      <label for="regnumber" class="col-sm-2 col-form-label">Staff Id</label>
      <div class="col-sm-10">
        <input type="text" name="regnumber" readonly class="form-control-plaintext" id="regnumber" value="<?php echo  sprintf("%05d", $profile->staff_id); ?>">
       
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" name="name" readonly class="form-control" id="name" value="<?php echo $profile->staff_name; ?>">
      </div>
    </div>

    <div class="form-group row pl-2">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $profile->email; ?>">
      </div>
    </div>
 
    <div class="form-group row pl-2">
      <label for="state" class="col-sm-2 col-form-label">Profile state</label>
      <div class="col-sm-10">
        <input type="text" name="state" readonly class="form-control-plaintext" id="state" value="<?php echo $profile->state; ?>">
      </div>
    </div>
    
    <div class="form-group row pl-2">
      <label for="role" class="col-sm-2 col-form-label">User role</label>
      <div class="col-sm-10">
        <input type="text" name="role" readonly class="form-control-plaintext" id="role" value="<?php echo $profile->user_role; ?>">
      </div>
    </div>
    
    <?php 
    }
    echo '<a class="btn btn-dark m-2 text-white" data-role="' . $profile->user_role . '" id="edit_profile">Edit</a>';
    echo '<button class="btn btn-primary my-3">Update</button>';
    echo form_close();
  
  ?>
  </div>
  
  <div class="tab-pane fade" id="password" >
  <?php echo form_open("user/profileUpdate/password/$profile->user_role"); ?>
    <div class="form-group row pl-2 mt-4">
      <label for="currentpsw" class="col-sm-2 col-form-label">Current password</label>
      <div class="col-sm-10 pass_show">
        <input type="password" name="currentpsw" class="form-control" id="currentpsw" >
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="newpsw" class="col-sm-2 col-form-label">New password</label>
      <div class="col-sm-10 pass_show">
        <input type="password" name="newpsw" class="form-control" id="newpsw" >
      </div>
    </div>
    <div class="form-group row pl-2">
      <label for="confirmnewpsw" class="col-sm-2 col-form-label">Confirm password</label>
      <div class="col-sm-10 pass_show">
        <input type="password" name="confirmnewpsw" class="form-control" id="confirmnewpsw" >
      </div>
    </div>
    <!-- <button type="reset" class="btn btn-dark m-2">Reset</button> -->
    <button class="btn btn-primary my-3">Update</button>
    <?php echo form_close(); ?>
  </div>
  
  <!-- <div class="tab-pane fade" id="notification">
  <?php 
      
      //  print_r($student_object);
      echo  '<table class="table">
      <thead class="thead-dark">
      <tr>
        <th scope="col">Course name</th>
        <th scope="col">Batch number</th>
        <th scope="col">payment history</th>

        
      </tr>
    </thead>';

echo "<tbody>";
//  echo '<pre>';
      foreach ($student_object as $key => $batch) {
        
        echo "<tr>";
        echo "<td>";
           print_r($batch->batch_object->course_detail->course_name); 
        echo "</td>";
        echo "<td>";
           print_r($batch->batch_object->batch_number); 
        echo "</td>";

        echo "<td>";
          //  print_r($batch); 
          if(!empty($batch->payment_object)){
            // print_r(count($batch->payment_object)); 
            echo "<table class='table table-bordered'>";
            foreach ($batch->payment_object as $key => $payment) {
              // print_r($payment);
              echo "<td>";
              echo "Payment status -";
              echo   ($payment->payment_status == 'full') ? 'full paid' :  $payment->payment_status;
              echo '<br>';
              echo "Pay amount -" .  $payment->amount . '<br>';
              echo "Payment due date -" .  $payment->payment_due_date . '<br>';
              if(isset($payment->payment_receive) &&  !empty($payment->payment_receive)){
                echo 'Paid receipt # -' . $payment->payment_receive->receipt_number . '<br>';   
                echo 'Paid date - ' . $payment->payment_receive->paid_date . '<br>';
                echo "<a href='". base_url('user/printreceipt/'.$payment->payment_id .'/'.$payment->batch_id.'/'.$payment->student_id ) . "'>Print receipt</a>";
              }else{
                echo "<a href='". base_url('user/payInstallment/'.$payment->payment_id .'/'.$payment->batch_id.'/'.$payment->student_id ) . "'>Pay now</a>";
              }
              
              
              echo "</td>";
            }
            echo "</table>";

          }else{
            echo "No payment history found";
          }
          //  echo count($batch->payment_object);
        echo "</td>";
        echo "<td>";
           print_r($batch->certificate_no); 
        echo "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    ?>

  </div> -->
</div>
      
     
    </div>
 
    </div>
 



</div>






<?php $this->load->view('footer'); ?>
<script>
  $(document).ready(function(){
    $('#due-date').hide();
    $('#edit_profile').on('click',function(){
      let role = $(this).data('role');
      if( role == 'admin' || role == 'coordinator'){
        $('#email').removeAttr('readonly');
        $('#name').removeAttr('readonly');
      }else if(role == 'trainer'){
        $('#email').removeAttr('readonly');
        $('#fname').removeAttr('readonly');
        $('#lname').removeAttr('readonly');
        $('#bdate').removeAttr('readonly');
        
      }else if(role == 'student'){
        $('#email').removeAttr('readonly');
        $('#fname').removeAttr('readonly');
        $('#lname').removeAttr('readonly');
        $('#bdate').removeAttr('readonly');
        $('#telephone').removeAttr('readonly');
      }
     
    });
  });

  $(document).ready(function(){
$('.pass_show').append('<span class="ptxt">Show</span>');  
});
  

$(document).on('click','.pass_show .ptxt', function(){ 

$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

}); 
</script>