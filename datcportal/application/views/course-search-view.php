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
    <?php echo form_open('course/searchCourse'); ?>
    <div class="col-12">
    <h2>Course Search</h2>
    <div class="form-row">
      
        <div class="form-group col-md-5">
          
          <input value="<?php echo (isset($search_input) ? $search_input['search-text'] : ""); ?>" type="text" name="search-text" class="form-control" id="searchtext" placeholder="search text">
        </div>
        <div class="form-group col-md-5">
          
          <select id="type" name="type" class="form-control">
            <option value="1" <?php echo (isset($search_input) && $search_input['type'] == 1) ?  'selected':"" ; ?> >Course name</option>
            <option value="2" <?php echo (isset($search_input) && $search_input['type'] == 2) ?  'selected':"" ; ?> >Course description</option>
            <option value="3" <?php echo (isset($search_input) && $search_input['type'] == 3) ?  'selected':"" ; ?> >Course type</option>

          </select>
        </div>
        <div class="form-group col-md-2">

          <input type="submit" class="btn btn-primary" name="search" value="Search" >
        </div>
      <?php echo form_close(); ?>
  </div>
  </div>
    </div>
    <div class="row">
    <div class="col-12">
      
      
      <?php 
      if(isset($search_result)){
        // print_r($search_result);
       echo  '<table class="table">
          <thead class="thead-dark">
          <tr>
            <th scope="col">Course #</th>
            <th scope="col">Course name</th>
            <th scope="col" style="width:25.33%;">Course description</th>
            <th scope="col">Course fee</th>
            <th scope="col">State</th>
            <th scope="col">Coure type</th>
            <th scope="col">Created date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>';

  echo "<tbody>";
  foreach ($search_result as $key => $courseObject) {
    // print_r($studentObject);
    echo "<tr>";
      echo "<th> $courseObject->course_id </th>";
      echo "<td> $courseObject->course_name </td>";
      echo "<td> $courseObject->course_description </td>";
      echo "<td> $courseObject->course_fee </td>";
      echo "<td> $courseObject->state </td>";
      echo "<td> $courseObject->course_type </td>";
      echo "<td> $courseObject->submit_date </td>";
      echo "<td><a target='_blank' href='courseProfile/$courseObject->course_id' >view more</a></td>";
    echo "</tr>";
  }
    
    
  echo '</tbody></table>';






















      }
      
      ?>



    </div>
 
    </div>
 



</div>






<?php $this->load->view('footer'); ?>
<script>
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