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
                <h1>Mark Attendance</h1>
            </div>
            <div class="row">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php echo form_open('worker/attendanceSubmit') ?>
                <?php if (isset($attendance)) {
                    foreach ($attendance as $key => $value) { ?>
                        <div class="form-group">
                            <h3><?php printf($value->name) ?></h3>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary <?php if (0 == $value->status) {
                                                                    printf('active');
                                                                } ?>">
                                    <input type="radio" name="status" id="present<?php printf($value->worker_id) ?>" autocomplete="off" <?php if (0 == $value->status) {
                                                                                                                                                printf('checked');
                                                                                                                                            } ?>> Present
                                </label>
                                <label class="btn btn-secondary <?php if (0 == $value->status) {
                                                                    printf('active');
                                                                } ?>">
                                    <input type="radio" name="status" id="absent<?php printf($value->worker_id) ?>" autocomplete="off" <?php if (0 == $value->status) {
                                                                                                                                            printf('checked');
                                                                                                                                        } ?>> Absent
                                </label>
                            </div>

                        </div>
                    <?php } ?>
            </div>
            <div class="row">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </div>
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
    <script>
        $('.btn').on('click', function() {
            $(this).siblings('label').removeClass('active');
            $(this).addClass('active');
        });
    </script>
</body>

</html>