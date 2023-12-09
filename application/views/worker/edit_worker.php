<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <script src="<?php echo base_url() . '/js/jquery-3.2.1.slim.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/jquery-ui.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/popper.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/bootstrap.min.js' ?>"></script>
    <script>
        $("#datepicker").datepicker("setDate", " <?php echo $workerdata['dob'] ?> ");
    </script>
    <title>Profle</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>My Profile</h1>
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
                print_r($this->session->userdata('userinfo'));
                // print_r($myprofile);
                echo form_open('worker/editWorkerSubmit');
                echo "<table class='table'>";
                foreach ($workerdata as $key => $value) {

                    echo "<input type='hidden' name='worker_id' value='{$value->worker_id}'>";
                    echo "<tr>";
                    echo "<td>";
                    echo "Name";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->name}' name='name'>";
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
                    echo '<input type="text" id="datepicker" name="dob">';
                    echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Employment Status";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->emp_status}' name='emp_status>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Wage";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->wage}' name='wage'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "EPF";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->EPF}' name='EPF'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "EPF Number";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->EPF_No}' name='EPF_No'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "ETF";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->ETF}' name='ETF'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "ETF Number";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->ETF_no}' name='TF_no'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Eduation";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->education}' name='education'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Gender";
                    echo "</td>";
                    echo "<td>";
                ?> <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary <?php if ('Male' == $value->gender) {
                                                            echo 'active';
                                                        } ?>">
                            <input type="radio" name="gender" id="Male" autocomplete="off" <?php if ('Male' == $value->gender) {
                                                                                                echo 'checked';
                                                                                            } ?>> Male
                        </label>
                        <label class="btn btn-secondary <?php if ('Female' == $value->gender) {
                                                            echo 'active';
                                                        } ?>">
                            <input type="radio" name="gender" id="Female" autocomplete="off" <?php if ('Female' == $value->gender) {
                                                                                                    echo 'checked';
                                                                                                } ?>> Female
                        </label>
                    </div>
                    <?php
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Address";
                    echo "</td>";
                    echo "<td>";
                    echo "<textarea class='form-control' name='address'>";
                    echo $value->address;
                    echo "</textarea>";
                    echo "</td>";
                    echo "</tr>";

                    ?>
                <?php
                }

                echo "</table>";
                echo "<input type='submit' class='btn btn-success' value='Update'>";
                echo form_close();
                ?>

            </div>
        </div>
    </div>
    <script>
        $('.btn-group').button('toggle');
    </script>

</body>

</html>