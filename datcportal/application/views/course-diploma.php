<?php $this->load->view('header'); ?>

<body>
  <?php $this->load->view('top-navigation'); ?>
  <header class="bg-primary py-5 mb-5 banner">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 banner-content-wrapper">
          <h1 class="display-4 text-white my-5 mb-2 text-center" style="text-transform: capitalize;"><?php echo $category ?> Courses</h1>

        </div>
      </div>
    </div>
  </header>

  <div class="container">

    <div class="row">
      <?php
      //print_r($course_wise_active_batch);
      $tabActivFlag = true;
      $tabContentActivFlag = true;
      echo '<ul class="nav nav-pills mb-3 col-12" id="pills-tab" role="tablist">';
      foreach ($course_wise_active_batch as $key => $active_course) {
        //print_r($active_course);
        echo '<li class="nav-item" role="presentation">';
        if($tabActivFlag){
          echo '<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#course'.$active_course->course_id.'" role="tab" aria-controls="pills-home" aria-selected="true">' . $active_course->course_name . '</a>';
          $tabActivFlag = false;
        }else{
          echo '<a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#course'.$active_course->course_id.'" role="tab" aria-controls="pills-home" aria-selected="true">' . $active_course->course_name . '</a>';
        }
        
        echo '</li>';
      }
      echo '</ul>';
      echo '<div class="tab-content" id="pills-tabContent">';
      foreach ($course_wise_active_batch as $key => $active_course) {
        

        if($tabContentActivFlag){
          echo '<div class="tab-pane fade show active" id="course'.$active_course->course_id.'" role="tabpanel" aria-labelledby="pills-home-tab">';
          $tabContentActivFlag = false;
        }else{
          echo '<div class="tab-pane fade show" id="course'.$active_course->course_id.'" role="tabpanel" aria-labelledby="pills-home-tab">';
        }
        
        echo '<div class="row">';
        echo '<hr>';
        echo '<div class="col-12">';
          
        echo '<h3>Course Overview</h3>
              <p>';
                echo $active_course->course_description;
              echo '</p>';
              

              echo '<h5>Course Fee:' .  $active_course->course_fee . '</h5>';
             echo '<hr>
              <h3>Batch Schecule</h3>';

        if (isset($active_course->datch_detail) && !empty($active_course->datch_detail)) {
          
          echo '<table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Batch Number</th>
                  <th scope="col">Commencement Date</th>
                  <th scope="col">Descirption</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>';
          foreach ($active_course->datch_detail as $key => $batch) {

            echo '<tr>';
            echo '<th scope="row">' . $batch->batch_number . '</th>';
            echo '<td>' . $batch->commence_date . '</td>';
            echo '<td>' . $batch->discription . '</td>';
            echo '<td><a href="'. base_url('user/veiwRegister/'.$batch->course_id.'/'.$batch->batch_number) . '" class="badge badge-success">Register </a></td>';

            echo '</tr>';
          }

          echo '</tbody>';
          echo '</table>';
          

          
        } else {
          echo "no new batch found";
        }
        echo '</div>';
        echo '<div class="col-4">';

          echo '</div>';
          echo '</div>';
          echo '</div>';
          
      }
      echo '</div>';
      ?>

      <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#courseOne" role="tab" aria-controls="pills-home" aria-selected="true">Diploma of Agribusiness management </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#courseTwo" role="tab" aria-controls="pills-profile" aria-selected="false">Diploma Of Horticulture </a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#courseThree" role="tab" aria-controls="pills-contact" aria-selected="false">Diploma of Export Agriculture </a>
        </li>

      </ul> -->
      <!-- <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="courseOne" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">
            <hr>
            <div class="col-8">
              <h3>Course Overview</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut non maiores deserunt voluptatum, cupiditate quo perferendis, similique, iusto doloremque maxime unde molestias. Sapiente maxime voluptatibus nulla dolor repellendus porro cumque!
              </p>
              <p>Suitable For: </p>
              <p>Certification: </p>

              <h5>Course Fee: Rs.30,000.00</h5>
              <hr>
              <h3>Batch Schecule</h3>

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Batch Number</th>
                    <th scope="col">Commencement Date</th>
                    <th scope="col">Descirption</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td><a href="" class="badge badge-success">Register </a></td>

                  </tr>

                </tbody>
              </table>




            </div>
            <div class="col-4">
              <h4>Sylabus</h4>
              <ul>
                <li>Module One:</li>
                <li>Module One:</li>
                <li>Module One:</li>
                <li>Module One:</li>
              </ul>
            </div>
          </div>


        </div>

        <div class="tab-pane fade" id="courseTwo" role="tabpanel" aria-labelledby="pills-profile-tab">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut non maiores deserunt voluptatum, cupiditate quo perferendis, similique, iusto doloremque maxime unde molestias. Sapiente maxime voluptatibus nulla dolor repellendus porro cumque!
          <h4>Course Fee: Rs.25,000.00</h4>
        </div>

        <div class="tab-pane fade" id="courseThree" role="tabpanel" aria-labelledby="pills-contact-tab">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut non maiores deserunt voluptatum, cupiditate quo perferendis, similique, iusto doloremque maxime unde molestias. Sapiente maxime voluptatibus nulla dolor repellendus porro cumque!
          <h4>Course Fee: Rs.30,000.00</h4>
        </div>


      </div> -->

    </div>



    <div class="text-center">
      <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
    </div>
  </div>







  <?php $this->load->view('footer'); ?>