<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Chemical Dashboard</title>
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
                    <div class="card text-white bg-secondary mb-3">

                        <div class="card-body">
                            <h5 class="card-title">Add Suppliers</h5>
                            <p class="card-text">Mark Chemicals Purchase</p>
                            <a href="<?php echo base_url() . 'chem_supplier/add_supplier' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>


                <div class="col-3">
                    <div class="card text-white bg-success mb-3">

                        <div class="card-body">
                            <h5 class="card-title">View Suppliers</h5>
                            <p class="card-text">View,edit and delete suppliers</p>
                            <a href="<?php echo base_url() . 'chem_supplier/view_suppliers' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

</body>

</html>