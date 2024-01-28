<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Dashboard</title>
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
            <?php if ($this->session->userdata('routing')['dashboard']) { ?>
                <?php foreach ($this->session->userdata('routing')['dashboard'] as $key => $value) { ?>
                    <?php if ($key == 'myprofile' && $value == 1) { ?>
                        <div class="col-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Users</h5>
                                    <p class="card-text">View/Edit Users</p>
                                    <a href="<?php echo base_url() . 'user/manage_user' ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($key == 'product' && $value == 1) { ?>
                        <div class="col-3">
                            <div class="card text-white bg-secondary mb-3">

                                <div class="card-body">
                                    <h5 class="card-title">Manage Workers</h5>
                                    <p class="card-text">Add/Remove/Modify Workers</p>
                                    <a href="<?php echo base_url() . 'worker/manage_worker' ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if ($key == 'reports' && $value == 1) { ?>
                        <div class="col-3">
                            <div class="card text-white bg-success mb-3">

                                <div class="card-body">
                                    <h5 class="card-title">Estate</h5>
                                    <p class="card-text">Manage and track estate activities</p>
                                    <a href="<?php echo base_url() . 'estate/manage_estate' ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <?php if ($key == 'reports' && $value == 1) { ?>
                        <div class="col-3">
                            <div class="card text-white bg-success mb-3">

                                <div class="card-body">
                                    <h5 class="card-title">Chemicals</h5>
                                    <p class="card-text">Manage and track chemicals activities</p>
                                    <a href="<?php echo base_url() . 'chemicals/manage_chemicals' ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($key == 'reports' && $value == 1) { ?>
                        <div class="col-3">
                            <div class="card text-white bg-success mb-3">

                                <div class="card-body">
                                    <h5 class="card-title">Fianaces</h5>
                                    <p class="card-text">Manage and track financial activities</p>
                                    <a href="<?php echo base_url() . 'finance/manage_finance' ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

</body>

</html>