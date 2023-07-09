<?php $this->load->view('header'); ?>

<body>
  <?php $this->load->view('top-navigation'); ?>
  <header class="bg-primary py-5 mb-5 banner">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 banner-content-wrapper">
          <h1 class="display-4 text-white my-5 mb-2 text-center">Certification Verification</h1>
          
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row center-title">
      <div class="col-md-12 text-center">
        
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <?php
       if (isset($error_message_display)) {


          echo '<div class="alert alert-danger" role="alert">';
          echo $error_message_display;
          echo '</div>';
        }elseif (isset($success_message_display)) {


          echo '<div class="alert alert-success" role="alert">';
          echo $error_message_display;
          echo '</div>';
        }
        ?>
        
        <!-- <p class="lead">To check the validity of a certificate, please follow the instructions below:</p>
        <ol>
          <li>Type the certificate number as it appears on the certificate, i.e XX100000000AA</li>
          <li>Complete the 'image verification' field</li>
          <li>Click 'submit'</li>
        </ol> -->
        
      <?php 
      
        // print_r($result_certificate);

        // print_r($result_certificate['course_details']);

      if(isset($result_certificate) && is_array($result_certificate)){
        echo "<h3 class='my-4'>Certificate ({$certificatenumber}) verified under following details</h3>";
        echo "<caption>Student Detail</caption>";
        echo "<table class='table'>";
        
          echo "<thead class='thead-dark'><tr>";
            echo "<th>Student ID</th><th>Name</th><th>Birth date</th><th>Register date</th>";

            
          echo "</tr></thead>";
          echo "<tbody>";
            echo "<tr>";
              echo "<td>";
                echo  $result_certificate['student_details']->student_id;
              echo "</td>";
              echo "<td>";
                echo $result_certificate['student_details']->first_name . ' ' .$result_certificate['student_details']->last_name;
              echo "</td>";
              echo "<td>";
                echo $result_certificate['student_details']->birth_date;
              echo "</td>";
              echo "<td>";
                echo $result_certificate['student_details']->register_date;
              echo "</td>";
            echo "</tr>";
          echo "</tbody>";
        echo "</table>";

        

        echo "<caption>Course Detail</caption>";
        echo "<table class='table'>";
        
          echo "<thead class='thead-dark'><tr>";
            echo "<th>Course Name</th><th>Batch #</th><th>Commence date</th><th>End date</th>";

            
          echo "</tr></thead>";
          echo "<tbody>";
            echo "<tr>";
              echo "<td>";
                echo  $result_certificate['course_details']->course_name;
              echo "</td>";
              echo "<td>";
                echo $result_certificate['batch_details']->batch_number;
              echo "</td>";
              echo "<td>";
                echo $result_certificate['batch_details']->commence_date;
              echo "</td>";
              echo "<td>";
                echo $result_certificate['batch_details']->close_date;
              echo "</td>";
            echo "</tr>";
          echo "</tbody>";
        echo "</table>";
      }else{
        echo '<div class="alert alert-success" role="alert">';
         echo "No certificate found";
        echo '</div>';
      }
      
      ?>
       
        
       
      
      
      </div>

    </div>
  </div>



  <div class="text-center">
    <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
  </div>
  </div>







  <?php $this->load->view('footer'); ?>