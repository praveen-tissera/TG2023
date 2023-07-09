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
      echo '</div><br>';

      if($online == 1){
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
      }else{
        $attributes = array('target' => '_blank','style'=>'display:inline');
        echo form_open('report/registrationPdf',$attributes);
        echo "<input type='hidden' name='studentdetail' value = '";
        print_r(serialize($student_details));
        echo  "'>";
        
       
       
        echo "<input type='submit' class='mt-4 form-group btn btn-warning'  value='Print Registration Card'>";
        echo form_close();

        echo form_open('report/receiptPdf',$attributes);
        echo "<input type='hidden' name='studentdetail' value = '";
        print_r(serialize($student_details));
        echo  "'>";
        
       
       
        echo "<input type='submit' class='mt-4 form-group btn btn-warning'  value='Print Receipt'>";
        echo form_close();
      }
        
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
  <div class="row">
    
    
    <?php 
    // print_r($studentManagement);
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          

          
  }
    
    ?>

    <div class="col-12">
      <h2>New Student Registration</h2>
      <?php 
      // print_r($all_courses);
      
      if(isset($all_courses) && !isset($select_course)){
        echo form_open('user/newRegistration/2');
        echo '<div class="form-group">';
        echo '<label>Select a course</label>';
        
         echo "<select name='selected_course' class='form-control'>";
        foreach ($all_courses as $key_course => $course) {
          // print_r($course);
          echo "<option value='{$course->course_id}'>";
          echo $course->course_name;
          echo "</option>";
        }
        echo "</select>";
        echo '</div>';
        
      }else if(isset($select_course) && isset($all_batches)){
        echo form_open('user/newRegistration/3');
        echo '<div class="form-group">';
          echo '<label>Selected course</label>';
          echo $select_course[0]->course_name;
          echo "<input type='hidden' value='{$select_course[0]->course_id}' name='course-id' >";
        echo "</div>";
        echo '<div class="form-group">';
          echo '<label>Select a batch</label>';
          echo "<br>";
          foreach ($all_batches as $key_batch => $batch) {
            // print_r($course);
            $js = 'onClick="feeCalculation(' . $select_course[0]->course_fee .',this)"';
            echo form_checkbox('completed[]',$batch->batch_id, FALSE,$js);
            // echo "<input type='checkbox' value='{$batch->batch_id}'>";
            echo "<label>" . $batch->batch_number. " (commence date: " . $batch->commence_date . ") </label>";
           echo "<br>";
          }
          $js = 'onClick="feeCalculation(100, this)"';
            echo form_checkbox('class-fee',100, FALSE,$js);
              
              echo "<label>" . 'Institute Fee'. " </label>";
              echo '<div class="form-group">
              <label>Total Fee</label>
              <input type="text" class="form-control" id="totalFee" name="total-fee" readonly>
    
            </div>';
           
          // echo "<select name='selected_batch' class='form-control'>";
          // foreach ($all_batches as $key_batch => $batch) {
          //   // print_r($course);
          //   echo "<option value='{$batch->batch_id}'>";
          //   echo $batch->batch_number. " (commence date: " . $batch->commence_date . ")";
          //   echo "</option>";
          // }
          // echo "</select>";
        echo '</div>';

        if($select_course[0]->course_type == 'diploma'){
          // calculate installment and installmeent due date
          $course_fee = number_format((float)$select_course[0]->course_fee, 2, '.', '');
          
          $installment_one = $select_course[0]->course_fee/2;
          
          
          $installment_one = number_format((float)$course_fee/2, 2, '.', '');
          
          $installment_two = ($course_fee - $installment_one);
          $installment_two = number_format((float)$installment_two, 2, '.', '');
          $installment_two_date = date('Y-m-d', strtotime("+6 months", strtotime($batch->commence_date)));
          echo "<input type='hidden' name='fullpayment' value='{$select_course[0]->course_fee}'>";
          echo "<input type='hidden' name='installmentone' value='$installment_one'>";
          echo "<input type='hidden' name='installmenttwo' value='$installment_two'>";
          echo '<div class="form-group">';
            echo '<label>Select a payment mode</label>';
            echo "<select name='payment_mode' class='form-control' id='pay_mode'>";
              echo "<option value='full'>Full Payment (". $select_course[0]->course_fee .")</option>";
              echo "<option value='1st installment'>Installment One (". $installment_one . ")</option>";  
            echo "</select>";
          echo '</div>';
        

        echo "<div id='due-date' name='due-date' class='form-group'>";
        echo '<label>Installment two due date</label>';
        echo  "<input type='text' name='due-date' value= '$installment_two_date' readonly  class='form-control'>";
        echo "</div>";

        }else if($select_course[0]->course_type == 'oneday' || $select_course[0]->course_type == 'threedays'){
          $month_array = ['January','February','March','April','June','July','August','September','Octmber','November','December'];
          echo '<div class="form-group">';
          echo '<label>Select payment month</label>';
          echo "<select name='selected-month' class='form-control'>";
        
          
          foreach ($month_array as $key_course => $month) {
            // print_r($course);
            echo "<option value='{$month}'>";
            echo $month;
            echo "</option>";
          }
          echo "</select>";
          echo '</div>';
          $course_fee = number_format((float)$select_course[0]->course_fee, 2, '.', '');
          
          $installment_one = $select_course[0]->course_fee/2;
          
          
          echo "<input type='text' name='fullpayment' value='{$select_course[0]->course_fee}'>";
          echo "<input type='text' name='installmentone' value='0'>";
          echo "<input type='text' name='installmenttwo' value='0'>";
          echo '<div class="form-group">';
            echo '<label>Select a payment mode</label>';
            echo "<select name='payment_mode' class='form-control' id='pay_mode'>";
              echo "<option value='full'>Full Payment (". $select_course[0]->course_fee .")</option>";
              
            echo "</select>";
          echo '</div>';
        

      

        }
        
        ?>
   <h3>Student details</h3>
      <div class="form-group">
          <label>First Name</label>
          <input type="text" value="<?php echo set_value('firstname'); ?>" class="form-control" name="firstname">

        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input value="<?php echo set_value('lastname'); ?>" type="text" class="form-control" name="lastname">

        </div>
        <div class="form-group">
          <label>Birth Date</label>
          <input value="<?php echo set_value('bdate'); ?>" type="date" class="form-control" name="bdate" >

        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input value="<?php echo set_value('email'); ?>" type="email" class="form-control" name="email" >

        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input value="<?php echo set_value('telephone'); ?>"  type="tel" class="form-control" name="telephone">

        </div>
        <div class="form-group">
          <label>Temporary password</label>
          <input type="text" class="form-control" name="password" placeholder="use student NIC number" >

        </div>
        <?php

      }
      echo "<a href='". base_url('user/newRegistration') . "' class='form-group mr-3 btn btn-dark'>Back</a>";
      echo '<button type="submit" class="form-group btn btn-primary">Next</button>';
      
      echo form_close();
      
      ?>



    </div>
 

 

  </div>

</div>






<?php $this->load->view('footer'); ?>
<script>
   var classFee = 0;
    function feeCalculation(amount,event){
      console.log(event.checked);
      if(event.checked){
        classFee = classFee + amount;
      $('#totalFee').val(classFee);
      }else{
        classFee = classFee - amount;
      $('#totalFee').val(classFee);
      }
     
    }
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