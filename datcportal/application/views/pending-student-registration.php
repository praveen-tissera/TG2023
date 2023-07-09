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
    <?php 
    // print_r($studentManagement);
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          
          // foreach ($studentManagement as $key => $value) {
          //   echo '<div class="col-4">';  
          //   echo '<a href="'. base_url('user/'.$key) . '">';
          //    echo  '<div class="card text-white bg-dark mb-4" style="max-width: 18rem; min-height:8rem;">';
          //       echo '<div class="card-body">';
          //     echo '<h5 class="card-title text-center pt-4">' . $value . '</h5>';
             
          //     echo '</div>';
                  
          //     echo '</div>';
          //     echo '</a>';
          //     echo '</div>';
          //   }
          
  }
    
    ?>

    <div class="col-12">
      <h2>Pending Student Registration</h2>
      <?php 
        //print_r($peding_student_registration);
      
      ?>

  <table class="table">
  <thead class="bg-info">
    <tr>
      <th scope="col">Student id</th>
      <th scope="col">Name</th>
      <th scope="col">Contact number</th>
      <th scope="col">email</th>
      
      <th scope="col">Register date</th>
      <th scope="col" colspan="3">Course name and Batch number</th>
      
      
      
    </tr>
  </thead>
  <tbody>
    <?php 
    if(isset($peding_student_registration)){
      foreach ($peding_student_registration as $key => $registration_course_detail) {
        //print_r($registration_course_detail);
        echo '<td>';
        echo $registration_course_detail->student_id;
        echo '</td>';
        echo '<td>';
        echo $registration_course_detail->first_name .' ' . $registration_course_detail->last_name;
        echo '</td>';
        echo '<td>';
        echo $registration_course_detail->telephone;
        echo '</td>';
        echo '<td>';
        echo $registration_course_detail->email;
        echo '</td>';
        echo '<td>';
        echo $registration_course_detail->register_date;
        echo '</td>';
        echo '<td>';
        echo '<table>';
        foreach ($registration_course_detail->batch_summary as $key => $batch_detail) {
          echo '<tr>';
          echo '<td>';
             echo $batch_detail->course_name;
          echo '</td>';
          echo '<td>';
             echo $batch_detail->batch_number;
          echo '</td>';
          echo '<td>';
          // student_id/course_id/batch_id/
             echo '<a href="'. base_url('user/registerStudent/pending/'.$registration_course_detail->student_id.'/'.$batch_detail->course_id.'/'.$batch_detail->batch_id) .'">Proceed</a>';
          echo '</td>';
            // print_r($bath_detail);
          echo '</tr>';
        }
        echo '</table>';
        echo '</td>';
        echo '</tr>';
      }
    }
     
      echo '</tbody>';
      echo '</table>';
    
    ?>
  </tbody>
</table>


    </div>
 

 

  </div>

</div>






<?php $this->load->view('footer'); ?>
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip('show')
  })
</script>