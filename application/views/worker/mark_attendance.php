<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Attendance</title>
    <script src="<?php echo base_url() . '/js/jquery-3.2.1.slim.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/popper.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/bootstrap.min.js' ?>"></script>

</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    $this->load->view('/common/carousel.php');

    ?>
    <div class="container">
        <div class="col">
            <div class="row">
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
            </div>
            <div class="row">
                <h1><?php echo ($date) ?> </h1>
            </div>

            <div class="row">
                <h3>Mark Attendance</h3>
            </div>
            <div class="row">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php echo form_open('worker/attendanceSubmit'); ?>

                <?php if (isset($attendance)) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Worker ID</th>
                                <th scope="col">Worker Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($attendance as $key => $value) { ?>
                                <div class="form-group">
                                    <tr>
                                        <th scope="row"><?php echo ($value->worker_id) ?></th>
                                        <td><?php echo ($value->name) ?></td>
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-secondary">
                                                    <input type="radio" name="status_<?php echo $value->worker_id ?>" id="present" autocomplete="off" value="1"> Present
                                                </label>
                                                <label class="btn btn-secondary">
                                                    <input type="radio" name="status_<?php echo $value->worker_id ?>" id="absent" autocomplete="off" value="0"> Absent
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </div>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h2>Error</h2>
                    <p>Something went wrong and the attendance data was not retrived</p>
            </div>
        <?php } ?>

        <?php $this->session->set_flashdata('attendance', $attendance); ?>
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
</body>

</html>