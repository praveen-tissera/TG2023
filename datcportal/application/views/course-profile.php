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
      <h2>Course Details</h2>
      <!-- tab panel -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Course</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#course" role="tab" aria-controls="profile" aria-selected="false">Batches</a>
  </li>

</ul>
<!-- tab conent -->
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile">
    <?php
    // echo '<pre>';
    // print_r($user_detail);
    // print_r($course_profile);
    if($user_detail['type'] == 'admin' || $user_detail['type'] =='coordinator'){
      
      echo form_open("course/courseUpdate");
    ?>
    <div class="alert alert-warning mt-3" role="alert">
        Course fee and course type change will not allowed once batches created.
    </div>
    <input type="hidden" name="courseid" value="<?php echo $course_profile[0]->course_id; ?>" >

      <div class="form-group row pl-2 mt-3">
       <label for="title" class="col-sm-2 col-form-label">Course title</label>
        <div class="col-sm-10">
          <input type="text" name="coursetitle" readonly class="form-control" id="title" id="coursetitle" value="<?php echo $course_profile[0]->course_name; ?>">
        </div>
      </div>

      <div class="form-group row pl-2">
       <label for="description" class="col-sm-2 col-form-label">Course description</label>
        <div class="col-sm-10">
         
          <textarea name="coursediscription" readonly id="description" cols="100" rows="5" class="form-control"><?php echo $course_profile[0]->course_description; ?></textarea>
        </div>
      </div>

      <div class="form-group row pl-2">
       <label for="fee" class="col-sm-2 col-form-label">Course fee</label>
        <div class="col-sm-10">
        <?php  if(isset($course_batches_object[0])){
              echo "<input type='text' name='fee' readonly class='form-control' id='feereadonly' value='{$course_profile[0]->course_fee}' >";
            }else{
              ?>
              <input type="text" name="fee" readonly class="form-control" id="fee" value="<?php echo $course_profile[0]->course_fee; ?>">
          <?php 
            }
          ?>

          
        </div>
      </div>

      <div class="form-group row pl-2">
       <label for="coursetype" class="col-sm-2 col-form-label">Course type</label>
        <div class="col-sm-10">
          <?php
            if(isset($course_batches_object[0])){
              echo "<input class='form-control' readonly type='text' name='coursetype' value='{$course_profile[0]->course_type}'>";
            }else{
              ?>

          <select readonly name="coursetype" id="coursetypedrop" class="form-control" >
            <option <?php echo ($course_profile[0]->course_type == 'diploma') ? 'selected' : ''; ?> value="diploma" >Diploma course</option>
            <option <?php echo ($course_profile[0]->course_type == 'threedays') ? 'selected' : ''; ?> value="threedays" >Threedays training</option>
            <option <?php echo ($course_profile[0]->course_type == 'oneday') ? 'selected' : ''; ?> value="oneday">Oneday training</option>
          </select>
    <?php
            }
          
          ?>
          
        </div>
      </div>

      <div class="form-group row pl-2">
       <label for="type" class="col-sm-2 col-form-label">Course created date</label>
        <div class="col-sm-10">
          <input readonly type="date" name="date"  class="form-control" id="date" value="<?php echo $course_profile[0]->submit_date; ?>">
        </div>
      </div>

      <div class="form-group row pl-2">
       <label for="coursestate" class="col-sm-2 col-form-label">Course state</label>
        <div class="col-sm-10">
          <select readonly id="coursestate" name="coursestate" class="form-control">
            <option <?php echo ($course_profile[0]->state == 'active') ? 'selected' : ''; ?> >active</option>
            <option <?php echo ($course_profile[0]->state == 'inactive') ? 'selected' : ''; ?>>inactive</option>
            <option <?php echo ($course_profile[0]->state == 'complete') ? 'selected' : ''; ?>>complete</option>
          </select>
         
        </div>
      </div>
    <?php 
    echo '<a class="btn btn-dark m-2 text-white" id="edit_profile">Edit</a>';
    echo '<button class="btn btn-primary my-3">Update</button>';
    echo form_close();
    }else{

    }
      
    ?>
  </div>
  <div class="tab-pane fade" id="course" >
    <?php 
      
      // print_r($student_object);
      echo  '<table class="table">
      <thead class="thead-dark">
      <tr>
        
        <th scope="col">Batch number</th>
        <th scope="col">Added by</th>
        <th scope="col">Created date</th>
        <th scope="col">Commence date</th>
        <th scope="col">Tentetive close date</th>
        <th scope="col">Completed date</th>
        <th scope="col">Trainer</th>
        <th scope="col">Batch description</th>
        <th scope="col">Batch status</th>
        <th></th>
        
        
      </tr>
    </thead>';

echo "<tbody>";
  // echo '<pre>';
  //   print_r($course_batches_object[0]);
  // echo "</pre>";

      foreach ($course_batches_object as $key => $batch) {
        
        echo "<tr>";
        echo "<td>";
           print_r($batch->batch_number); 
        echo "</td>";
        echo "<td>";
           print_r($batch->staff_object->staff_name); 
        echo "</td>";
        echo "<td>";
           print_r($batch->create_date); 
        echo "</td>";
        echo "<td>";
           print_r($batch->commence_date); 
        echo "</td>";
        echo "<td>";
           print_r($batch->tentitive_close_date); 
        echo "</td>";
        echo "<td>";
           print_r($batch->close_date); 
        echo "</td>";
        echo "<td>";
        if(isset($batch->trainer_object->trainer_detail)){
          print_r($batch->trainer_object->trainer_detail->first_name); 
        }else{
          echo "Trainer not found";
        }
           
        echo "</td>";
        echo "<td>";
           print_r($batch->discription); 
        echo "</td>";
        echo "<td>";
           print_r($batch->state); 
        echo "</td>";
        echo "<td>";
          echo "<a href='". base_url('course/editbatch/'.$batch->batch_id) . "'>Edit batch</a>"; 
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
       $('#title').removeAttr('readonly');
        $('#description').removeAttr('readonly');
        $('#fee').removeAttr('readonly');
        $('#coursetypedrop').removeAttr('readonly');
        $('#date').removeAttr('readonly');
        $('#coursestate').removeAttr('readonly');
    });
  });
</script>