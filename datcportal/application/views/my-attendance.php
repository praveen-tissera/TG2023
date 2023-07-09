<?php

if (!($this->session->userdata('user_detail'))) {

  redirect('/user/login');
} else {
  $user_detail = $this->session->userdata('user_detail');
}


?>



<?php $this->load->view('header'); ?>

<style>
  .pass_show {
    position: relative
  }

  .pass_show .ptxt {

    position: absolute;

    top: 50%;

    right: 40px;

    z-index: 1;

    color: #f36c01;

    margin-top: -10px;

    cursor: pointer;

    transition: .3s ease all;

  }

  .pass_show .ptxt:hover {
    color: #333333;
  }
</style>
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


  if (isset($this->session->userdata('user_detail')['user-wise-menu'])) {
    $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
  }

  ?>
  <div class="row">

    <div class="col-12">

    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h2>My Attendance</h2>




      <?php
      // print_r($enrol_courses);
      foreach ($enrol_courses as $enrol_course) {
        ?>
        <table class="table my-4 table-bordered">
          <thead class=" table-dark">
            <tr>
              <th>
                Course name
              </th>
              <th>
                Batch number
              </th>
              <th>
                Register date
              </th>
              <th>
                Student batch status
              </th>
              <th>
                Batch status
              </th>
              <th>
               Certificate
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $enrol_course->batch_object->course_detail->course_name; ?></td>
              <td><?php echo $enrol_course->batch_object->batch_number; ?></td>
              <td><?php echo $enrol_course->added_date; ?></td>
              <td><?php echo $enrol_course->state; ?></td>
              <td><?php echo $enrol_course->batch_object->state; ?></td>
              <td><?php 
              echo (!empty($enrol_course->certificate_no)) ? $enrol_course->certificate_no : 'Pending' ; 
              ?></td>
            </tr>
          </tbody>
        </table>
    </div>
           
           
            <?php
            // echo 'value'. count($enrol_course->payment_object);
            if (is_array($enrol_course->attendance) && !empty($enrol_course->attendance)) {
              foreach ($enrol_course->attendance as $key => $attendance) {
                if (empty($payment->payment_receive)) {
                  echo "<div class='col-3'>";
                  
                  echo '<div class="alert alert-primary">';
                  echo $attendance->attend_date;
                  echo '</div>';
                  echo "</div>";
                  echo "<div class='col-3'>";
                  if($attendance->status == 1){
                    echo '<div class="alert alert-success">';
                    echo $attendance->status;
                    echo '</div>';
                  }else{
                    echo '<div class="alert alert-danger">';
                    echo $attendance->status;
                    echo '</div>';
                  }
                  
                  echo "</div>";
                  
                } 

                ?>


              <?php
            }
          } else {
            echo "<div class='col-12'>";
              echo '<div class="alert alert-primary">';
              echo "No Attendance History Found";
              echo '</div>';
           
            echo '</div>';
          }
          ?>
          </tbody>
        </table>
      <?php
    }
    ?>




    </div>

  




</div>






<?php $this->load->view('footer'); ?>
<script>
  $(document).ready(function() {
    $('#due-date').hide();
    $('#edit_profile').on('click', function() {
      let role = $(this).data('role');
      if (role == 'admin' || role == 'coordinator') {
        $('#email').removeAttr('readonly');
        $('#name').removeAttr('readonly');
      } else if (role == 'trainer') {
        $('#email').removeAttr('readonly');
        $('#fname').removeAttr('readonly');
        $('#lname').removeAttr('readonly');
        $('#bdate').removeAttr('readonly');

      } else if (role == 'student') {
        $('#email').removeAttr('readonly');
        $('#fname').removeAttr('readonly');
        $('#lname').removeAttr('readonly');
        $('#bdate').removeAttr('readonly');
        $('#telephone').removeAttr('readonly');
      }

    });
  });

  $(document).ready(function() {
    $('.pass_show').append('<span class="ptxt">Show</span>');
  });


  $(document).on('click', '.pass_show .ptxt', function() {

    $(this).text($(this).text() == "Show" ? "Hide" : "Show");

    $(this).prev().attr('type', function(index, attr) {
      return attr == 'password' ? 'text' : 'password';
    });

  });
</script>