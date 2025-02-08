<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Finances</title>
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
                <h1>Current Finances </h1>
            </div>
            <div class="row">
                <?php if ($result != 0) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $key => $value) { ?>
                                <tr>
                                    <th scope="row">
                                    <?php echo ($value->id) ?>
                                    </th>
                                    <td><?php echo ($value->type) ?></td>
                                    <td><?php echo ($value->amount) ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                <?php } else { ?>
                    <h2>Error</h2>
                    <p>Something went wrong and the current financial data was not retrived</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    $this->load->view('/common/footer.php');
    ?> 
</body>

</html>