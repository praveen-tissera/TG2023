<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Manage workers</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">

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
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">View/Modify</h5>
                        <p class="card-text">View and Modify all workers</p>
                        <a href="<?php echo base_url() . 'worker/view_worker' ?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Mark attendance</h5>
                        <p class="card-text">Mark Attendance for the day</p>
                        <a href="<?php echo base_url() . 'worker/mark_attendance' ?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reigster</h5>
                        <p class="card-text">Add new workers</p>
                        <a href="<?php echo base_url() . 'worker/register_worker' ?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>