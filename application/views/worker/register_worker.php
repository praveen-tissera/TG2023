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
    <style>
        .hide {
            display: none;
        }
    </style>
    <title>Register</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    $this->load->view('/common/carousel.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
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
                <h1>Register New Worker</h1>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('worker/register_worker_Submit') ?>
                <table class="table">
                    <tr>
                        <td colspan="2">Register page</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input class="form-control" type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Date Of Birth</td>
                        <td><input class="form-control" type="date" name="dob"></td>
                    </tr>
                    <tr>
                        <td>Employment Status</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="emp_status" id="Permanent" autocomplete="off" value="permanent" onclick="perm_emp();">Permanent
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="emp_status" id="Temporary" autocomplete="off" value="temporary" onclick="temp_emp();"> Temporary
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Wage (Rs.)</td>
                        <td><input class="form-control" type="text" name="wage"></td>
                    </tr>
                    <tr>
                        <td>EPF</td>
                        <td><input class="form-control" type="text" name="EPF" id="EPF"></td>
                    </tr>
                    <tr>
                        <td>EPF Number</td>
                        <td><input class="form-control" type="text" name="EPF_no" id="EPF_no"></td>
                    </tr>
                    <tr>
                        <td>ETF</td>
                        <td><input class="form-control" type="text" name="ETF" id="ETF"></td>
                    </tr>
                    <tr>
                        <td>ETF Number</td>
                        <td><input class="form-control" type="text" name="ETF_no" id="ETF_no"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="gender" id="Male" autocomplete="off" value="Male">Male
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="gender" id="Female" autocomplete="off" value="Female">Female
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Education</td>
                        <td>
                            <textarea class="form-control" name="education" cols="30" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <textarea class="form-control" name="address" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Register"></td>
                    </tr>

                </table>
                <?php echo form_close(); ?>

            </div>
        </div>

    </div>
    <?php
    $this->load->view('/common/footer.php');
    ?>
    <script>
        $('.btn-group').button('toggle');
    </script>
    <script>
        function temp_emp() {
            document.getElementById("EPF").setAttribute("disabled", "1");
            document.getElementById("EPF_no").setAttribute("disabled", "1");
            document.getElementById("ETF").setAttribute("disabled", "1");
            document.getElementById("ETF_no").setAttribute("disabled", "1");
        }
    </script>
    <script>
        function perm_emp() {
            document.getElementById("EPF").removeAttribute('disabled');
            document.getElementById("EPF_no").removeAttribute('disabled');
            document.getElementById("ETF").removeAttribute('disabled');
            document.getElementById("ETF_no").removeAttribute('disabled');
        }
    </script>
</body>

</html>