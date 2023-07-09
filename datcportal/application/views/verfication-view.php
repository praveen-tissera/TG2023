<?php $this->load->view('header'); ?>

<body>
  <?php $this->load->view('top-navigation'); ?>
  <header class="bg-primary py-5 mb-5 banner">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 banner-content-wrapper">
          <h1 class="display-4 text-white my-5 mb-2 text-center">Certification Verification</h1>
          
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row center-title">
      <div class="col-md-12 text-center">
        
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
        <p class="lead">To check the validity of a certificate, please follow the instructions below:</p>
        <ol>
          <li>Type the certificate number as it appears on the certificate, i.e XX100000AA</li>
          <li>Complete the 'image verification' field</li>
          <li>Click 'submit'</li>
        </ol>
        <?php
        
          echo form_open('user/verification/2')
        ?>
        <div class="form-group">
          <label>Certificate number</label>
          <input type="text" class="form-control" pattern ="[A-Z]{2}\d+[A-A]{2}" name="certificatenumber">
        </div>
        <div class="form-group">
          <label>Image verification</label>
          <input type="text" class="form-control" name="captcha">
        </div>
        <?php 
          echo "<p>";
          // print_r($cap);
          echo $cap['image'];

          echo "</p>";
        ?>
        
        <input type="submit" class="btn btn-dark my-4" value="Submit">

      
      
      </div>

    </div>
  </div>



  <div class="text-center">
    <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
  </div>
  </div>







  <?php $this->load->view('footer'); ?>