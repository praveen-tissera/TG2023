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
  </div>
  <?php
  // print_r($studentManagement);

  if (isset($this->session->userdata('user_detail')['user-wise-menu'])) {
    $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
  }

  ?>

  <div class="row">
    <div class="col-12">


      <?php
      // print_r($trainer_batch_details);
      if (isset($trainer_batch_details)) {
        // print_r($search_result);
        echo "<h2>Trainer Assign Active Batches</h2>";
        echo  '<table class="table">
          <thead class="thead-dark">
          <tr>
            <th scope="col">Course name</th>
            <th scope="col">Batch number</th>
            
            <th scope="col">Start date</th>
            <th scope="col">Tentetive closing date</th>
            <th scope="col">Batch details</th>
            
            
          </tr>
        </thead>';

        echo "<tbody>";
        
        if(is_array($trainer_batch_details)){
          foreach ($trainer_batch_details as $key => $trainerObject) {
            // print_r($trainerObject);
            if ($trainerObject->state == 'active') {
              echo "<tr>";
              echo "<th> {$trainerObject->batch_object->course_detail->course_name} </th>";
              echo "<td> {$trainerObject->batch_object->batch_number} </td>";
  
              echo "<td> {$trainerObject->batch_object->commence_date} </td>";
              echo "<td> {$trainerObject->batch_object->tentitive_close_date}</td>";
              echo "<td> {$trainerObject->batch_object->discription} </td>";
  
              echo "</tr>";
            }
          }
        }else{
          echo "<tr><td>No batch allocation found</td></tr>";
        }
        


        echo '</tbody></table>';

        echo "<hr>";

        echo "<h2>Trainer Batches Assign History</h2>";
        echo  '<table class="table">
          <thead class="thead-dark">
          <tr>
            <th scope="col">Course name</th>
            <th scope="col">Batch number</th>
            
            <th scope="col">Start date</th>
            <th scope="col">Tentetive closing date</th>
            <th scope="col">Batch details</th>
            
            
          </tr>
        </thead>';

        echo "<tbody>";
        if(is_array($trainer_batch_details)){
          foreach ($trainer_batch_details as $key => $trainerObject) {
          
            if ($trainerObject->state != 'active') {
              echo "<tr>";
              echo "<th> {$trainerObject->batch_object->course_detail->course_name} </th>";
              echo "<td> {$trainerObject->batch_object->batch_number} </td>";
  
              echo "<td> {$trainerObject->batch_object->commence_date} </td>";
              echo "<td> {$trainerObject->batch_object->tentitive_close_date}</td>";
              echo "<td> {$trainerObject->batch_object->discription} </td>";
  
              echo "</tr>";
            }
          }
        }else{
          echo "<tr><td>No batch allocation found</td></tr>";
        }
        


        echo '</tbody></table>';
      }

      ?>



    </div>

  </div>




</div>






<?php $this->load->view('footer'); ?>
<script>
  $(document).ready(function() {
    $('#due-date').hide();
    $('#pay_mode').on('change', function() {
      var installment = $(this).val();
      if (installment == '1st installment') {
        $('#due-date').show();
      } else {
        $('#due-date').hide();
      }
    });
  });
</script>