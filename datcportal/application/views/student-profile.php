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
  </div>
    <?php 
    // print_r($studentManagement);
    
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
      <h2>Student Details</h2>
      <!-- tab panel -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#course" role="tab" aria-controls="profile" aria-selected="false">Course</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="contact" aria-selected="false">Payments</a>
  </li>
</ul>
<!-- tab conent -->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile">
    <?php
    // echo '<pre>';
    //   print_r($student_profile);

      if($user_detail['type'] == 'admin' || $user_detail['type'] =='coordinator'){
      
        echo form_open("user/studentProfileUpdate");

    ?>
      <div class="form-group row pl-2 mt-3">
       <label for="studentid" class="col-sm-2 col-form-label">Registration number</label>
        <div class="col-sm-10">
          <input type="text" name="studentid" readonly class="form-control" id="title" id="studentid" value="<?php echo sprintf("%05d", $student_profile->student_id); ?>">
          
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="fname" class="col-sm-2 col-form-label">First name</label>
        <div class="col-sm-10">
          <input type="text" name="fname" readonly class="form-control"  id="fname" value="<?php echo $student_profile->first_name; ?>">
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="lname" class="col-sm-2 col-form-label">last name</label>
        <div class="col-sm-10">
          <input type="text" name="lname" readonly class="form-control"  id="lname" value="<?php echo $student_profile->last_name; ?>">
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $student_profile->email; ?>">
        </div>
      </div>

      
      <div class="form-group row pl-2 mt-3">
       <label for="telephone" class="col-sm-2 col-form-label">Contact number</label>
        <div class="col-sm-10">
          <input type="text" name="telephone" readonly class="form-control" id="telephone"  value="<?php echo $student_profile->telephone; ?>">
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
        <div class="col-sm-10">
          <input type="date" name="bdate" readonly class="form-control"  id="bdate" value="<?php echo $student_profile->birth_date; ?>">
        </div>
      </div>

        
      <div class="form-group row pl-2 mt-3">
       <label for="studentstate" class="col-sm-2 col-form-label">Student profile state</label>
        <div class="col-sm-10">
          

          <select readonly id="studentstate" name="studentstate" class="form-control">
            <option <?php echo ($student_profile->state == 'active') ? 'selected' : ''; ?> >active</option>
            <option <?php echo ($student_profile->state == 'pending') ? 'selected' : ''; ?>>pending</option>
            <option <?php echo ($student_profile->state == 'inactive') ? 'selected' : ''; ?>>inactive</option>
          </select>


        </div>
      </div>


      <div class="form-group row pl-2 mt-3">
       <label for="regdate" class="col-sm-2 col-form-label">Register date</label>
        <div class="col-sm-10">
          <input type="text" name="regdate" readonly class="form-control" id="title" id="regdate" value="<?php echo $student_profile->register_date; ?>">
        </div>
      </div>


    <?php
    echo '<a class="btn btn-dark m-2 text-white" id="edit_profile">Edit</a>';
    echo '<button class="btn btn-primary my-3">Update</button>';
      echo form_close();
      }else{
    ?>
         <div class="form-group row pl-2 mt-3">
       <label for="studentid" class="col-sm-2 col-form-label">Registration number</label>
        <div class="col-sm-10">
          <input type="text" name="studentid" readonly class="form-control" id="title" id="studentid" value="<?php echo sprintf("%05d", $student_profile->student_id); ?>">
          
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="fname" class="col-sm-2 col-form-label">First name</label>
        <div class="col-sm-10">
          <input type="text" name="fname" readonly class="form-control"  id="fname" value="<?php echo $student_profile->first_name; ?>">
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="lname" class="col-sm-2 col-form-label">last name</label>
        <div class="col-sm-10">
          <input type="text" name="lname" readonly class="form-control"  id="lname" value="<?php echo $student_profile->last_name; ?>">
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $student_profile->email; ?>">
        </div>
      </div>

      
      <div class="form-group row pl-2 mt-3">
       <label for="telephone" class="col-sm-2 col-form-label">Contact number</label>
        <div class="col-sm-10">
          <input type="text" name="telephone" readonly class="form-control" id="telephone"  value="<?php echo $student_profile->telephone; ?>">
        </div>
      </div>

      <div class="form-group row pl-2 mt-3">
       <label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
        <div class="col-sm-10">
          <input type="date" name="bdate" readonly class="form-control"  id="bdate" value="<?php echo $student_profile->birth_date; ?>">
        </div>
      </div>

        
      <div class="form-group row pl-2 mt-3">
       <label for="studentstate" class="col-sm-2 col-form-label">Student profile state</label>
        <div class="col-sm-10">
          

          <select readonly id="studentstate" name="studentstate" class="form-control">
            <option <?php echo ($student_profile->state == 'active') ? 'selected' : ''; ?> >active</option>
            <option <?php echo ($student_profile->state == 'pending') ? 'selected' : ''; ?>>pending</option>
            <option <?php echo ($student_profile->state == 'inactive') ? 'selected' : ''; ?>>inactive</option>
          </select>


        </div>
      </div>


      <div class="form-group row pl-2 mt-3">
       <label for="regdate" class="col-sm-2 col-form-label">Register date</label>
        <div class="col-sm-10">
          <input type="text" name="regdate" readonly class="form-control" id="title" id="regdate" value="<?php echo $student_profile->register_date; ?>">
        </div>
      </div>  
      
    <?php 

      }
    ?>
  </div>
  <div class="tab-pane fade" id="course" >
    <?php 
      
      // print_r($student_object);
      echo  '<table class="table">
      <thead class="thead-dark">
      <tr>
        <th scope="col">Course name</th>
        <th scope="col">Batch number</th>
        <th scope="col">Student regiser date on batch</th>
        <th scope="col">Student batch status</th>
        <th scope="col">Certificate status</th>
        <th scope="col">action</th>
        
      </tr>
    </thead>';

echo "<tbody>";
//  echo '<pre>';
if($user_detail['type'] == 'admin' || $user_detail['type'] =='coordinator'){
      
  

      foreach ($student_object as $key => $batch) {
        echo form_open("user/studentBatchUpdate");
        echo "<input type='hidden' name='batchid' value='{$batch->batch_id}'>";
        echo "<input type='hidden' name='studentid' value='{$batch->student_id}'>";
        echo "<tr>";
        echo "<td>";
           print_r($batch->batch_object->course_detail->course_name); 
        echo "</td>";
        echo "<td>";
           print_r($batch->batch_object->batch_number); 
        echo "</td>";
        echo "<td>";
           print_r($batch->added_date); 
        echo "</td>";
        echo "<td>";
          //  print_r($batch->state); 
          ?>
           <select readonly id="studentstate" name="studentstate" class="form-control-sm">
            <option <?php echo ($batch->state == 'active') ? 'selected' : ''; ?> >active</option>
            <option <?php echo ($batch->state == 'suspend') ? 'selected' : ''; ?>>suspend</option>
            <option <?php echo ($batch->state == 'pending') ? 'selected' : ''; ?>>pending</option>
          </select>
          <?php 
        echo "</td>";
        echo "<td>";
           print_r($batch->certificate_no); 
        echo "</td>";
        echo "<td>";
            // echo '<a class="btn btn-dark mr-2 btn-sm  text-white" id="edit_profile">Edit</a>';
            echo '<button class="btn btn-primary btn-sm">Update</button>';
        echo "</td>";
        echo "</tr>";
        echo form_close();
      }
      
      echo "</tbody>";
      echo "</table>";
    }else{
      foreach ($student_object as $key => $batch) {
        
        echo "<tr>";
        echo "<td>";
           print_r($batch->batch_object->course_detail->course_name); 
        echo "</td>";
        echo "<td>";
           print_r($batch->batch_object->batch_number); 
        echo "</td>";
        echo "<td>";
           print_r($batch->added_date); 
        echo "</td>";
        echo "<td>";
           print_r($batch->state); 
        echo "</td>";
        echo "<td>";
           print_r($batch->certificate_no); 
        echo "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    }
    ?>
  </div>
  <div class="tab-pane fade" id="payment">
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
                echo "<a href='". base_url('report/printreceipt/'.$payment->payment_id .'/'.$payment->batch_id.'/'.$payment->student_id ) . "'>Print receipt</a>";
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

  </div>
</div>
      
      <?php 
      
    
      
      ?>



    </div>
 
    </div>
 



</div>






<?php $this->load->view('footer'); ?>
<script>
  $(document).ready(function(){
    $('#edit_profile').on('click',function(){
       $('#fname').removeAttr('readonly');
        $('#lname').removeAttr('readonly');
        $('#email').removeAttr('readonly');
        $('#telephone').removeAttr('readonly');
        $('#bdate').removeAttr('readonly');
        $('#studentstate').removeAttr('readonly');
    });
  });
</script>