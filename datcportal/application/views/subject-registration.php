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
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          

          
  }
    
    ?>
    <div class="row">




        <div class="col-4">

            <?php 
        if(isset($active_courses)){
          echo '<label>Course name</label>';
          echo form_open('course/newSubject/2');
          echo "<select class='form-control' name='selectcourse'>";
          // print_r($active_courses);
          foreach ($active_courses as $key => $active_course) {
              echo "<option value='{$active_course->course_id}'>$active_course->course_name</option>";
          }
          echo "</select>";
        }elseif (isset($select_course_detail)) {
          echo '<label>Selected course</label>';
            echo "<p>{$select_course_detail[0]->course_name}</p>";
           
        }
        
      ?>

        </div>
        <?php
     

          if(isset($subjects) && is_array($subjects)){
            echo '<div class="col-8">';
            echo "<table class='table'>";
              echo "<tr>";
                echo "<th>Subject #</th>";
                echo "<th>Subject Name</th>";
                echo "<th>Status</th>";
                echo "<th></th>";
                
              echo "</tr>";
              foreach ($subjects as $key => $value) {
                echo "<tr>";
                  echo "<td>";
                    echo $value->subject_id;
                  echo "</td>";
                  echo "<td>";
                    echo $value->subject_name;
                  echo "</td>";
                  echo "<td>";
                    echo $value->state;
                  echo "</td>";
                  echo "<td>";
                    echo "<a href='". base_url('course/newSubject/2/'.$value->course_id.'/'.$value->subject_id.'/1') . "' >edit</a>";
                  echo "</td>";
                echo "</tr>";
              }

            echo "</table>";
            // print_r($subjects);
          echo '</div>';
          }elseif(isset($subjects) && $subjects == 0){
            echo "No subject found";
          }
        ?>


    </div>

    <?php
      
        
          echo "<div class='row'>";
            echo "<div class='col-12'>";
            if(isset($subjects) && isset($subject_detail)){
              echo '<h3 class="mt-4">Update Subject</h3>';
              echo form_open('course/newSubject/4'); ?>

          <input type="hidden" name="courseid" value="<?php echo $select_course_detail[0]->course_id; ?>">
          <input type="hidden" name="subjectid" value="<?php echo $subject_detail[0]->subject_id; ?>">
          <div class="form-group">
              <label for="subject">Subject Title</label>
              <input type="subject" required name="subject"class="form-control" id="subject" value="<?php echo $subject_detail[0]->subject_name ?>">

          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="state" id="status">
              <option <?php echo  ($subject_detail[0]->state == 'active') ? 'selected' : '' ?>>active</option>
              <option <?php echo ($subject_detail[0]->state == 'inactive') ? 'selected' : '' ?>>inactive</option>
              
            </select>

            <?php }
            elseif(isset($subjects)){
              echo '<h3 class="mt-4">Add New Subject</h3>';
              echo form_open('course/newSubject/3');
              // print_r($select_course_detail);

          ?>
          <input type="hidden" name="courseid" value="<?php echo $select_course_detail[0]->course_id; ?>">
          <div class="form-group">
              <label for="subject">Subject Title</label>
              <input required type="subject" name="subject"class="form-control" id="subject">

          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="state" id="status">
              <option>active</option>
              <option>inactive</option>
              
            </select>
          </div>


    <?php }
           
          
          


        
      
          echo "</div>";
        echo "</div>";
     
      
     
      ?>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-dark mt-2" href="<?php echo base_url('course/newSubject')?>">Back</a>
            <button type="submit" class="mt-4 form-group btn btn-primary">Next</button>
        </div>


        <?php  echo form_close();?>
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