<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Manage Users</title>
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
                                    <h5 class="card-title">My Profile</h5>
                                    <p class="card-text">View/Edit your profile</p>
                                    <a href="<?php echo base_url() . 'user/profile' ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($key == 'teamprofile' && $value == 1) { ?>
                        <div class="col-3">
                            <div class="card text-white bg-primary mb-3">

                                <div class="card-body">
                                    <h5 class="card-title">Add new users</h5>
                                    <p class="card-text">Add users</p>
                                    <a href="<?php echo base_url() . 'user/register' ?>" class="stretched-link"></a>
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