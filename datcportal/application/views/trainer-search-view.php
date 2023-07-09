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
    <?php echo form_open('trainer/searchTrainer'); ?>
    <div class="col-12">
    <h2>Trainer Search</h2>
    <div class="form-row">
      
        <div class="form-group col-md-5">
          
          <input value="<?php echo (isset($search_input) ? $search_input['search-text'] : ""); ?>" type="text" name="search-text" class="form-control" id="searchtext" placeholder="search text">
        </div>
        <div class="form-group col-md-5">
          
          <select id="type" name="type" class="form-control">
            <option value="1" <?php echo (isset($search_input) && $search_input['type'] == 1) ?  'selected':"" ; ?> >Trainer name</option>
            <option value="2" <?php echo (isset($search_input) && $search_input['type'] == 2) ?  'selected':"" ; ?> >Registeration number</option>
            <option value="3" <?php echo (isset($search_input) && $search_input['type'] == 3) ?  'selected':"" ; ?> >Trainer email address</option>

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
            <th scope="col">Registration #</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">status</th>
            <th scope="col">Register date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>';

  echo "<tbody>";
  foreach ($search_result as $key => $trainerObject) {
    // print_r($studentObject);
    echo "<tr>";
      echo "<th> $trainerObject->trainer_id </th>";
      echo "<td> $trainerObject->first_name </td>";
      echo "<td> $trainerObject->last_name </td>";
      echo "<td> $trainerObject->email </td>";
      echo "<td> $trainerObject->state </td>";
      echo "<td> $trainerObject->register_date </td>";
      
      echo "<td><a target='_blank' href='". base_url("/user/reset/$trainerObject->trainer_id/trainer")."' >Rest password</a> <a target='_blank' href='trainerProfile/$trainerObject->trainer_id' >View more</a></td>";
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