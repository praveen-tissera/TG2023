<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Estate Dashboard</title>
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
            <?php if ($this->session->userdata('routing')) { ?>
                <div class="col-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Estate History</h5>
                            <p class="card-text">View Estate History</p>
                            <a href="<?php echo base_url() . 'estate/view_history' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>



                <div class="col-3">
                    <div class="card text-white bg-secondary mb-3">

                        <div class="card-body">
                            <h5 class="card-title">Add Estate Work</h5>
                            <p class="card-text">Add work done on current date</p>
                            <a href="<?php echo base_url() . 'estate/add_work' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>




                <div class="col-3">
                    <div class="card text-white bg-success mb-3">

                        <div class="card-body">
                            <h5 class="card-title">Add Weather</h5>
                            <p class="card-text">Add the weather for today</p>
                            <a href="<?php echo base_url() . 'estate/weather' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <?php if ($this->session->userdata('routing')) { ?>

                    <div class="col-3">
                        <div class="card text-white bg-secondary mb-3">

                            <div class="card-body">
                                <h5 class="card-title">View 1 day Report</h5>
                                <p class="card-text">View indepth information about 1 day</p>
                                <a href="<?php echo base_url() . 'estate/one_day_report' ?>" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>
        </div>
    </div>

</body>

</html>