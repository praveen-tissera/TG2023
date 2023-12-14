<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Workers</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Workers</h1>
                <?php
                if (isset($success)) {
                    echo "<div class='alert alert-success'>";
                    echo $success;
                    echo "</div>";
                }
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>";
                    echo $error;
                    echo "</div>";
                }

                ?>
                <?php
                foreach ($result as $key => $value) {
                    echo "<table class='table'>";

                    echo "<tr>";
                    echo "<td>";
                    echo "<h3>";
                    echo "Name";
                    echo "</h3>";
                    echo "</td>";
                    echo "<td>";
                    echo "<h3>";
                    echo $value->name;
                    echo "</h3>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Worker ID";
                    echo "</td>";
                    echo "<td>";
                    echo $value->worker_id;
                    echo "</td>";
                    echo "</tr>";


                    echo "<tr>";
                    echo "<td>";
                    echo "Date Of Birth";
                    echo "</td>";
                    echo "<td>";
                    echo $value->dob;
                    echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Employment Status";
                    echo "</td>";
                    echo "<td>";
                    echo $value->emp_status;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Wage";
                    echo "</td>";
                    echo "<td>";
                    echo $value->wage;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "EPF";
                    echo "</td>";
                    echo "<td>";
                    echo $value->EPF;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "EPF Number";
                    echo "</td>";
                    echo "<td>";
                    echo $value->EPF_no;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "ETF";
                    echo "</td>";
                    echo "<td>";
                    echo $value->ETF;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "ETF Number";
                    echo "</td>";
                    echo "<td>";
                    echo $value->ETF_no;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Gender";
                    echo "</td>";
                    echo "<td>";
                    echo $value->gender;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Education";
                    echo "</td>";
                    echo "<td>";
                    echo $value->education;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Address";
                    echo "</td>";
                    echo "<td>";
                    echo $value->address;
                    echo "</td>";
                    echo "</tr>";
                ?>

                    <?php
                    echo "</table>";
                    echo "<h1>Please Confirm Deletion of Worker</h1>";
                    if ($this->session->userdata('routing')['profile']['edit']) { ?>
                        <a class="btn btn-warning" href="<?php echo base_url() . '/worker/deleteworker_confirmation/' . $value->worker_id ?>" role="button">Delete Worker</a>
                <?php }
                }
                ?>



            </div>
        </div>
    </div>

</body>

</html>