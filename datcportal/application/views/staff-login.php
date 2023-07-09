<?php $this->load->view('header'); ?>
<div class="sidenav">
         <div class="login-main-text">
             <a href="<?php echo base_url(); ?>" class="text-white"> &lt; Back To Home </a>
            <h2 class="mt-4">Create Tech  Institute<br> </h2>
            <p>Login for Create Tech  Staff Members</p>
         </div>
      </div>
      <div class="main">
 
         <div class="col-md-6 col-sm-12">
         
            <div class="login-form">

                <?php 
                echo form_open('user/staffMemberLogin');  
                ?>
                <?php
                  if(isset($error_message_display)){
                     echo '<div class="alert alert-danger" role="alert">';
                     echo $error_message_display;
                     echo '</div>';
                     }
                     if(isset($success_message_display)){
                     echo '<div class="alert alert-secondary" role="alert">';
                     echo $success_message_display;
                     echo '</div>';
                     }
                ?>

                  <div class="form-group">
                     <label>Email <?php echo (form_error('email')) ? '<span class="badge badge-danger">Email field required</span>' : '';?> </label>
                     <input type="text" name="email" class="form-control" placeholder="Email Address" >
                  </div>
                  <div class="form-group">
                     <label>Password <?php echo (form_error('password')) ? '<span class="badge badge-danger">Password field required</span>' : '';?></label>
                     <input type="password" name="password" class="form-control" placeholder="Password" >
                  </div>


                  <button type="submit" class="btn btn-black">Login</button>
                  
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>