<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Financial Dashboard</title>
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
                            <h5 class="card-title">Expense</h5>
                            <p class="card-text">Add expenses</p>
                            <a href="<?php echo base_url() . 'finance/expense' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Add Expense type</h5>
                            <p class="card-text">Add a new expense Type</p>
                            <a href="<?php echo base_url() . 'finance/add_expenses' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Income</h5>
                            <p class="card-text">Add Income</p>
                            <a href="<?php echo base_url() . 'finance/income' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card text-white bg-secondary mb-3">

                        <div class="card-body">
                            <h5 class="card-title">Add Income type</h5>
                            <p class="card-text">Add a new income type</p>
                            <a href="<?php echo base_url() . 'finance/add_income_type' ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
            <?php } ?>
        </div>
    </div>

</body>

</html>