<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Delete Supplier</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Delete Supplier</h1>
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
                <?php
                foreach ($result as $key => $value) {
                ?>
                    <table class='table'>
                        <tr>
                            <td>
                                <h3>Name</h3>
                            </td>
                            <td>
                                <h3><?php echo ($value->name); ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Supplier ID
                            </td>
                            <td>
                                <?php echo ($value->supplier_id); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Address
                            </td>
                            <td>
                                <?php echo ($value->address); ?>
                            </td>
                        </tr>
                        <?php
                        echo "</table>";
                        echo "<h1>Please Confirm Deletion of Chemical</h1>";
                        if ($this->session->userdata('routing')['profile']['edit']) { ?>
                            <a class="btn btn-warning" href="<?php echo base_url() . '/chem_supplier/delete_supplier_confirmation/' . $value->supplier_id ?>" role="button">Delete Supplier</a>
                    <?php }
                    }
                    ?>



            </div>
        </div>
    </div>

</body>

</html>