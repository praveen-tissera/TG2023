<?php

if (!($this->session->userdata('user_detail'))) {

  redirect('/user/login');
} else {
  $user_detail = $this->session->userdata('user_detail');
}


?>
<?php $this->load->view('header'); ?>
<style>
  .partpayment{
    display: none;
  }
</style>

<body>
  <?php
  $this->load->view('top-navigation');
  $this->load->view('staff-navigation');
  ?>


  <div class="container">
    <div class="row center-title">
      <div class="col-md-12 text-center">

      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <?php
        if (isset($success_message_display)) {
          echo "success";
        } elseif (isset($error_message_display)) {


          echo '<div class="alert alert-danger" role="alert">';
          echo $error_message_display;
          echo '</div>';
        } elseif (isset($success_message_display)) {


          echo '<div class="alert alert-success" role="alert">';
          echo $error_message_display;
          echo '</div>';
        }
        ?>

        <div class="jumbotron">
          <?php 
          // print_r($student_detail);
           ?>
          <hr>
          <?php 
          // print_r($course_detail); 
          ?>
          <hr>
          <?php 
          // print_r($batch_detail); 
          ?>
          <p class="lead"><?php echo 'Course Name: ' . $course_detail[0]->course_name; ?></p>
          <p class="lead"><?php echo 'Batch Number: ' . $batch_detail[0]->batch_number; ?></p>
          <p class="lead"><?php echo 'Student ID: ' . $student_detail[0]->student_id; ?></p>

        </div>
        <?php



        echo form_open('user/studentRegisterconfirm');
        // print_r($course_detail);
        // print_r($batch_detail);

        
        ?>
        <input type="text" name="student-id" value="<?php echo $student_detail[0]->student_id; ?>" >
        <input type="text" name="batch-id" value="<?php echo $batch_detail[0]->batch_id; ?>" >
        <input type="text" name="course-id" value="<?php echo $course_detail[0]->course_id; ?>" >
        <div class="form-group">
          <label>First Name</label>
          <input type="text" class="form-control" name="firstname" value="<?php echo $student_detail[0]->first_name; ?>">

        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="lastname" value="<?php echo $student_detail[0]->last_name; ?>">

        </div>
        <div class="form-group">
          <label>Birth Date</label>
          <input type="date" class="form-control" name="bdate" value="<?php echo $student_detail[0]->birth_date; ?>">

        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" name="email" value="<?php echo $student_detail[0]->email; ?>">

        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="tel" class="form-control" name="telephone" value="<?php echo $student_detail[0]->telephone; ?>">

        </div>
        <?php
        if ($course_detail[0]->course_type = 'diploma') {
          echo '<div class="form-check form-check-inline">';
          
          echo "<input class='form-check-input' id='fullpay' checked type='radio' name='pay_type' value='1'>";
          echo '<label class="form-check-label" for="fullpay">Full Payment</label>';

          echo '</div>';
          echo '<div class="form-check form-check-inline">';
          
          echo "<input class='form-check-input' id='partpay' type='radio' name='pay_type' value='2'>";
          echo '<label class="form-check-label" for="partpay">Installment payment</label>';

          echo '</div>';
        }
        ?>

        <?php 
          $course_fee = number_format((float)$course_detail[0]->course_fee, 2, '.', '');
          
          $installment_one = $course_detail[0]->course_fee/2;
          
          
          $installment_one = number_format((float)$course_fee/2, 2, '.', '');
          
          $installment_two = ($course_fee - $installment_one);
          $installment_two = number_format((float)$installment_two, 2, '.', '');


          $installment_two_date = date('Y-m-d', strtotime("+6 months", strtotime($batch_detail[0]->commence_date)));
          
          
          
        ?>
        <!-- full payment -->
        <div class="form-group fullpayment">
          <label>Full payment</label>
          
          <input type="text" class="form-control" name="fullpayment" value="<?php echo $course_detail[0]->course_fee; ?>">

        </div>
        <!-- part payment -->
        <div class="partpayment">
          <div class="form-group">
            <label>Installment One</label>
            <input type="text" class="form-control" name="installment-one" value="<?php echo $installment_one; ?>">

          </div>

          <div class="form-group">
            <label>Installment Two</label>
            <input type="text" class="form-control" name="installment-two" value="<?php echo $installment_two; ?>">

          </div>
          <div class="form-group">
            <label>Installment two due date</label>
            <input type="date" class="form-control" name="installment-two-date" value="<?php echo $installment_two_date;?>">

          </div>
        </div>
        <br>
        <input type="submit" class="btn btn-dark my-4" value="Register">



        <?php
        echo form_close();

        ?>
      </div>

    </div>
  </div>



  <div class="text-center">
    <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
  </div>
  </div>







  <?php $this->load->view('footer'); ?>


  <script>
    $(document).ready(function(){
      
      $('input[name="pay_type"]').on('click',function(){
        
        var pay_type = $('input[name="pay_type"]:checked').val();
        if(pay_type == '2'){
          // console.log($('input[name="pay_type"]:checked').val());
          $('.partpayment').css('display','block');
          $('.fullpayment').css('display','none');
        }else{
          $('.partpayment').css('display','none');
        }
      })
     
    });
  </script>