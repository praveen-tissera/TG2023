<?php $this->load->view('header'); ?>

<body>
  <?php $this->load->view('top-navigation'); ?>
  <header class="bg-primary py-5 mb-5 banner">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 banner-content-wrapper">
          <h1 class="display-4 text-white my-5 mb-2 text-center">Course Registration</h1>
          
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row center-title">
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
    <div class="row">
      <div class="col-8">
        <?php
       if (isset($error_message_display)) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $error_message_display;
          echo '</div>';
        }elseif (isset($success_message_display)) {
          echo '<div class="alert alert-success" role="alert">';
          echo $error_message_display;
          echo '</div>';
        }
        ?>
        
        <div class="jumbotron">
          
          <p class="lead"><?php echo 'Course Name: ' . $course_detail[0]->course_name; ?></p>
          <p class="lead"><?php echo 'Batch Number: ' . $batch_detail[0]->batch_number; ?></p>
          
        </div>
        <?php
        
      //print_r($this->session->userdata('user_detail'));
      // if student already logged in we dont need to register aganin just update batch detail only
        if($this->session->userdata('user_detail') && $this->session->userdata('user_detail')['type'] == 'student'){
          
          if($student_register_to_course == 0){
            echo '<a href="'.base_url('user/studentRegisterOnline/' . $course_detail[0]->course_id . '/' . $batch_detail[0]->batch_id) .'" class="btn btn-primary">Confirm to Register</a> ';
          }else{
            
            echo '<div class="alert alert-danger" role="alert">';
              echo "already registerd to this batch";
            echo '</div>';
          }
          
         }else{
        echo form_open('user/studentRegisterOnline/' . $course_detail[0]->course_id . '/' . $batch_detail[0]->batch_id);
        // print_r($course_detail);
        // print_r($batch_detail);

        ?>
        
        <div class="form-group">
          <label>First Name</label>
          <input type="text" class="form-control" name="firstname">

        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="lastname">

        </div>
        <div class="form-group">
          <label>Birth Date</label>
          <input type="date" class="form-control" name="bdate">

        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" name="email">

        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="tel" class="form-control" name="telephone">

        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password">

        </div>
        <input type="submit" class="btn btn-dark my-4" value="Register">

        <?php
        echo form_close();
        }
        ?>
      </div>

    </div>
  </div>



  <div class="text-center">
    <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
  </div>
  </div>







  <?php $this->load->view('footer'); ?>