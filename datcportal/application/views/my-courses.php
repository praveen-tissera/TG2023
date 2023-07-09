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
      <h2>My Coures</h2>




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
            <tr>
              <td colspan="6" class="text-center bg-info text-white">Payment History</td>
            </tr>
            <tr class="bg-info text-white">
              <td>Payment status</td>
              <td>Course Fee</td>
              <td>Paid amount</td>
              <td>Payment receipt</td>
              <td>Paid date</td>
              <td>Due date</td>

            </tr>
            <?php
            // echo 'value'. count($enrol_course->payment_object);
            if (is_array($enrol_course->payment_object) && !empty($enrol_course->payment_object)) {
              foreach ($enrol_course->payment_object as $key => $payment) {
                if (empty($payment->payment_receive)) {
                  echo "<tr>";
                  echo "<td>{$payment->payment_status}</td>";
                  echo "<td>{$enrol_course->batch_object->course_detail->course_fee}</td>";
                  echo "<td>Pending</td>";
                  echo "<td>N/A</td>";
                  echo "<td>N/A</td>";
                  echo "<td>{$payment->payment_due_date}</td>";
                  
                  echo "</tr>";
                } else {
                  echo "<tr>";
                  
                  
                  echo "<td>";
                  echo ($payment->payment_status == 'full') ? 'Full Paid' : $payment->payment_status;
                  echo "</td>";
                  echo "<td>{$enrol_course->batch_object->course_detail->course_fee}</td>";
                  echo "<td>{$payment->payment_receive->paid_amount}</td>";
                  echo "<td>{$payment->payment_receive->receipt_number}</td>";
                  echo "<td>{$payment->payment_receive->paid_date}</td>";
                  echo "<td>N/A</td>";
                  echo "</tr>";
                }

                ?>


              <?php
            }
          } else {
            echo '<tr>';
            echo '<td colspan ="6">No Payment History Found</td>';
            echo '</tr>';
          }
          
          ?>
            <tr>
              <td colspan="6" class="text-center bg-warning text-white">Marks</td>
            </tr>
            <?php 
              if(is_array($enrol_course->marks_object) && !empty($enrol_course->marks_object)){
                echo "<tr><td colspan='4'>Subject Name</td><td>Marks</td><td>Final Grade</td></tr>";
                foreach ($enrol_course->marks_object as $key => $mark) {
                  echo "<tr>";
                    echo "<td colspan='4'>";
                      echo $mark->subject_name->subject_name;
                    echo "</td>";
                    echo "<td>";
                      echo $mark->mark;
                    echo "</td>";
                    echo "<td>";
                      echo $mark->state;
                    echo "</td>";
                  echo "</tr>";
                }
              }else{
                echo '<tr>';
              echo '<td colspan ="6">No Marks Found</td>';
              echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      <?php
    }
    ?>




    </div>

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