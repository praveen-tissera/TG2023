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

    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h2>Trainer Details</h2>
      <!-- tab panel -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#course" role="tab" aria-controls="profile" aria-selected="false">Course</a>
        </li>

      </ul>
      <!-- tab conent -->
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="profile">
          <?php
          // echo '<pre>';
          // print_r($trainer_profile);
          if($user_detail['type'] == 'admin' || $user_detail['type'] =='coordinator'){
            echo form_open("trainer/trainerProfileUpdate");
            ?>
               <div class="form-group row pl-2 mt-3">
                <label for="trainerid" class="col-sm-2 col-form-label">Registration number</label>
                  <div class="col-sm-10">
                    <input type="text" name="trainerid" readonly class="form-control" id="trainerid" value="<?php echo sprintf("%05d", $trainer_profile[0]->trainer_id); ?>">
                    
                  </div>
                </div>

                <div class="form-group row pl-2 mt-3">
                  <label for="fname" class="col-sm-2 col-form-label">First name</label>
                    <div class="col-sm-10">
                      <input type="text" name="fname" readonly class="form-control"  id="fname" value="<?php echo $trainer_profile[0]->first_name; ?>">
                    </div>
                  </div>

                  <div class="form-group row pl-2 mt-3">
                  <label for="lname" class="col-sm-2 col-form-label">last name</label>
                    <div class="col-sm-10">
                      <input type="text" name="lname" readonly class="form-control"  id="lname" value="<?php echo $trainer_profile[0]->last_name; ?>">
                    </div>
                  </div>

                  <div class="form-group row pl-2 mt-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $trainer_profile[0]->email; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group row pl-2 mt-3">
                      <label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
                        <div class="col-sm-10">
                          <input type="date" name="bdate" readonly class="form-control"  id="bdate" value="<?php echo $trainer_profile[0]->birth_date; ?>">
                        </div>
                      </div>


                      <div class="form-group row pl-2 mt-3">
                        <label for="trainerstate" class="col-sm-2 col-form-label">Student profile state</label>
                          <div class="col-sm-10">
                            

                            <select readonly id="studentstate" name="studentstate" class="form-control">
                              <option <?php echo ($trainer_profile[0]->state == 'active') ? 'selected' : ''; ?> >active</option>
                              
                              <option <?php echo ($trainer_profile[0]->state == 'inactive') ? 'selected' : ''; ?> >inactive</option>
                            </select>


                          </div>
                        </div>

                        <div class="form-group row pl-2 mt-3">
                          <label for="regdate" class="col-sm-2 col-form-label">Register date</label>
                            <div class="col-sm-10">
                              <input type="text" name="regdate" readonly class="form-control" id="title" id="regdate" value="<?php echo $trainer_profile[0]->register_date; ?>">
                            </div>
                          </div>

   

            <?php
            echo '<a class="btn btn-dark m-2 text-white" id="edit_profile">Edit</a>';
            echo '<button class="btn btn-primary my-3">Update</button>';
              echo form_close();
          }else{
            ?>
              <div class="form-group row pl-2 mt-3">
                <label for="trainerid" class="col-sm-2 col-form-label">Registration number</label>
                  <div class="col-sm-10">
                    <input type="text" name="trainerid" readonly class="form-control" id="trainerid" value="<?php echo sprintf("%05d", $trainer_profile[0]->trainer_id); ?>">
                    
                  </div>
                </div>

                <div class="form-group row pl-2 mt-3">
                  <label for="fname" class="col-sm-2 col-form-label">First name</label>
                    <div class="col-sm-10">
                      <input type="text" name="fname" readonly class="form-control"  id="fname" value="<?php echo $trainer_profile[0]->first_name; ?>">
                    </div>
                  </div>

                  <div class="form-group row pl-2 mt-3">
                  <label for="lname" class="col-sm-2 col-form-label">last name</label>
                    <div class="col-sm-10">
                      <input type="text" name="lname" readonly class="form-control"  id="lname" value="<?php echo $trainer_profile[0]->last_name; ?>">
                    </div>
                  </div>

                  <div class="form-group row pl-2 mt-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="email" readonly class="form-control" id="email" value="<?php echo $trainer_profile[0]->email; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group row pl-2 mt-3">
                      <label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
                        <div class="col-sm-10">
                          <input type="date" name="bdate" readonly class="form-control"  id="bdate" value="<?php echo $trainer_profile[0]->birth_date; ?>">
                        </div>
                      </div>


                      <div class="form-group row pl-2 mt-3">
                        <label for="trainerstate" class="col-sm-2 col-form-label">Student profile state</label>
                          <div class="col-sm-10">
                            

                            <select readonly id="studentstate" name="studentstate" class="form-control">
                              <option <?php echo ($trainer_profile[0]->state == 'active') ? 'selected' : ''; ?> >active</option>
                              <option <?php echo ($trainer_profile[0]->state == 'pending') ? 'selected' : ''; ?> >pending</option>
                              <option <?php echo ($trainer_profile[0]->state == 'inactive') ? 'selected' : ''; ?> >inactive</option>
                            </select>


                          </div>
                        </div>

                        <div class="form-group row pl-2 mt-3">
                          <label for="regdate" class="col-sm-2 col-form-label">Register date</label>
                            <div class="col-sm-10">
                              <input type="text" name="regdate" readonly class="form-control" id="title" id="regdate" value="<?php echo $trainer_profile[0]->register_date; ?>">
                            </div>
                          </div>
            <?php
          }

          ?>
        </div>
        <div class="tab-pane fade" id="course">
          <?php

          // print_r($student_object);
          echo  '<table class="table">
      <thead class="thead-dark">
      <tr>
        <th scope="col">Course name</th>
        <th scope="col">Batch number</th>
        <th scope="col">Trainer assign date to the batch</th>
        <th scope="col">Trainer batch status</th>
        <th scope="col">Batch Description</th>
        
      </tr>
    </thead>';

          echo "<tbody>";
          //  echo '<pre>';
          if(is_array($trainer_batches_object) ){
            foreach ($trainer_batches_object as $key => $batch) {

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
              print_r($batch->batch_object->discription);
              echo "</td>";
              echo "</tr>";
            }
          }else{
            echo '<div class="alert alert-danger" role="alert">';
            echo "no batch allocation found";
            echo "</div>";
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