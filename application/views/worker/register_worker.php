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
    <title>Register</title>
</head>

<body>
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
                <h1>Register New User</h1>

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
                        <td>Date Of Birth (YYYY-MM-DD)</td>
                        <td><input class="form-control" type="text" name="dob"></td>
                    </tr>
                    <tr>
                        <td>Employment Status</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="emp_status" id="Permanent" autocomplete="off" value="permanent">Permanent
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="emp_status" id="Temporary" autocomplete="off" value="temporary"> Temporary
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Wage</td>
                        <td><input class="form-control" type="text" name="wage"></td>
                    </tr>
                    <tr>
                        <td>EPF</td>
                        <td><input class="form-control" type="text" name="EPF"></td>
                    </tr>
                    <tr>
                        <td>EPF Number</td>
                        <td><input class="form-control" type="text" name="EPF_no"></td>
                    </tr>
                    <tr>
                        <td>ETF</td>
                        <td><input class="form-control" type="text" name="ETF"></td>
                    </tr>
                    <tr>
                        <td>ETF Number</td>
                        <td><input class="form-control" type="text" name="ETF_no"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="gender" id="Male" autocomplete="off" value="Male">Male
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="emp_status" id="Female" autocomplete="off" value="Female">Female
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
    <script>
        $('.btn-group').button('toggle');
    </script>
</body>

</html>