
<?php

if ($this->session->userdata('user_detail')) {

  redirect('/user/studentTrainerDashboard');
} 


?>

<?php $this->load->view('header'); ?>
<div class="sidenav">
   <div class="login-main-text">
      <a href="<?php echo base_url(); ?>" class="text-white"> &lt; Back To Home </a>
      <h2 class="mt-4">Create Tech  Institute<br> </h2>
      <p>Login for Students and Trainers.</p>
   </div>
</div>
<div class="main">

   <div class="col-md-6 col-sm-12">

      <div class="login-form">

         <?php
         echo form_open('user/studentTrainerLogin');
         ?>
         <?php
         if (isset($error_message_display)) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $error_message_display;
            echo '</div>';
         }
         if (isset($success_message_display)) {
            echo '<div class="alert alert-secondary" role="alert">';
            echo $success_message_display;
            echo '</div>';
         }
         ?>
     
         <div class="form-group">
            <label>Email <?php echo (form_error('email')) ? '<span class="badge badge-danger">Email field required</span>' : ''; ?> </label>
            <input type="text" name="email" class="form-control" placeholder="Email Address" >
         </div>
         <div class="form-group">
            <label>Password <?php echo (form_error('password')) ? '<span class="badge badge-danger">Password field required</span>' : ''; ?></label>
            <input type="password" name="password" class="form-control" placeholder="Password" >
         </div>

         <div class="form-group">
            <label>Slect User Group : </label>
            <div class="form-check form-check-inline">
               <input class="form-check-input" checked type="radio" name="user-type" id="student" value="student">
               <label class="form-check-label" for="student">Student</label>
            </div>
            <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="user-type" id="trainer" value="trainer">
               <label class="form-check-label" for="trainer">Trainer</label>
            </div>
         </div>
         <button type="submit" class="btn btn-black">Login</button>

         <?php echo form_close(); ?>
      </div>
   </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
   $('#sel_user').change(function(){
    var username = $(this).val();
    console.log('userid',username);
    $.ajax({
     url:'<?=base_url()?>user/userDetails',
     method: 'post',
     data: {username: username},
     dataType: 'json',
     success: function(response){
       var len = response.length;
      //  console.log(response);
       console.log(response[0].email);
      //  $('#suname,#sname,#semail').text('');
      //  if(len > 0){
      //    // Read values
      //    var uname = response[0].username;
      //    var name = response[0].name;
      //    var email = response[0].email;
 
      //    $('#suname').text(uname);
      //    $('#sname').text(name);
      //    $('#semail').text(email);
 
      //  }
 
     }
   });
  });
 });
 </script>