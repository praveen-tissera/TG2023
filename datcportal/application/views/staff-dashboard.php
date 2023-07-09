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



<br>

<div class="container py-4">
  <div class="row">
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
    <?php 
    
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
      $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
          
          foreach ($userMenu as $key => $value) {
            echo '<div class="col-4">';  
            echo '<a href="'. base_url('user/'.$key) . '">';
             echo  '<div class="card text-white bg-success mb-4" style="max-width: 18rem; min-height:8rem;    box-shadow: 0px 0px 8px #013f01;">';
                echo '<div class="card-body">';
              echo '<h5 class="card-title text-center pt-4">' . $value . '</h5>';
             
              echo '</div>';
                  
              echo '</div>';
              echo '</a>';
              echo '</div>';
            }
          
  }
    
    ?>
 
 

 

  </div>

</div>






<?php $this->load->view('footer'); ?>
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip('show')
  })
</script>