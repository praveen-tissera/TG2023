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

  if (isset($this->session->userdata('user_detail')['user-wise-menu'])) {
    $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
  }

  ?>
  <div class="row">

<?php 
  // print_r($dues);

?>
  <table class="table">
    <tr>
      <th>Registration number</th>
      <th>Student name</th>
      <th>Status</th>
      <th>Contact number</th>
      <th>Course</th>
      <th>Batch</th>
      <th>Due date</th>
      <th>Due age</th>
      <th>Amount</th>
    </tr>

    <?php 
    $dueage;
      foreach ($dues as $key => $due) {
        $now = time(); // or your date as well
              $your_date = strtotime($due->payment_due_date);
              $datediff = $now - $your_date;
              
              $dueage = round($datediff / (60 * 60 * 24)); 
        if($dueage > 0){


    ?>

       <tr>
         <td><?php echo sprintf("%05d", $due->student_id); ?></td>
         <td><?php echo $due->student_detail->first_name . ' ' . $due->student_detail->last_name; ?></td>
         <td><?php echo $due->batch_student_detail->state; ?></td>
         <td><?php echo $due->student_detail->telephone; ?></td>
         <td><?php echo $due->course_detail->course_name; ?></td>
         <td><?php echo sprintf("%03d", $due->batch_detail->batch_number); ?></td>
         <td><?php echo $due->payment_due_date; ?></td>
         <td><?php 
              echo $dueage;
              ?>
        </td>
         <td><?php echo  number_format($due->amount, 2); ?></td>
       </tr>

     <?php   
      }
      
    }
    if($dueage < 0){
      echo "<tr><td colspan='9'> No dues found</td></tr>";
    }
      ?>
    
    

  </table>

    
    


  </div>
  
  


 
 
  <div class="row">
    <div class="col-12">
      <!-- <a class="btn btn-dark mt-2" href="<?php echo base_url('report/registrationReport') ?>">Back</a>
      <button type="submit" class="mt-4 form-group btn btn-primary">Next</button>
     -->


    <?php echo form_close(); ?>
    <?php
    if (isset($dueage) && $dueage > 0) {
      $attributes = array('target' => '_blank','style'=>'display:inline');
      echo form_open('report/duepdf',$attributes);
      
      echo "<input type='hidden' name='dues' value = '";
      
      print_r(serialize($dues));
      echo  "'>";
      // echo "<input type='hidden' name='startdate' value='$select_start_date'>";
      // echo "<input type='hidden' name='enddate' value='$select_end_date'>";
      echo "<input type='submit' class='mt-4 form-group btn btn-warning'  value='down pdf'>";
      echo form_close();
    }

    ?>
  </div>
    
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


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
</script>
<script type="text/javascript">
  google.charts.load('current', {
    packages: ['corechart']
  });
</script>
<?php

?>
<script language="JavaScript">
  let regitstration = +$('#chart_div').data("value");
  let start_date = $('#chart_div').data("sdate");
  let end_date = $('#chart_div').data("edate");
  let duration = 'Period (' + start_date + ' to ' + end_date + ')';

  function drawChart() {
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'registration');
    data.addColumn('number', 'count');
    data.addRows([
      ['Total Registration - ' + regitstration, regitstration],

    ]);

    // Set chart options


    var options = {
      legend: 'none',
      pieSliceText: 'label',
      title: 'Student Registration' + duration,
      pieStartAngle: 100,
    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
  google.charts.setOnLoadCallback(drawChart);
</script>