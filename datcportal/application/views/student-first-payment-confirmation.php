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
          
          
          echo '<div class="alert alert-success" role="alert">';
          echo $success_message_display;

          print_r($student_details);
          
          // print_r($student_detail);
          echo '</div>';


          $attributes = array('target' => '_blank','style'=>'display:inline');
          echo form_open('report/onlineRegistrationPdf',$attributes);
          echo "<input type='hidden' name='studentdetail' value = '";
          print_r(serialize($student_details));
          echo  "'>";
          
         
         
          echo "<input type='submit' class='mt-4 form-group btn btn-warning'  value='Print Registration Card'>";
          echo form_close();
  
          echo form_open('report/onlineReceiptPdf',$attributes);
          echo "<input type='hidden' name='studentdetail' value = '";
          print_r(serialize($student_details));
          echo  "'>";
          
         
         
          echo "<input type='submit' class='mt-4 form-group btn btn-warning'  value='Print Receipt'>";
          echo form_close();
        } elseif (isset($error_message_display)) {


          echo '<div class="alert alert-danger" role="alert">';
          echo $error_message_display;
          echo '</div>';
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