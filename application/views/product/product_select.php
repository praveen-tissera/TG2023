<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Product</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Select Product</h1>
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
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php echo form_open('product/product_select') ?>
                <table class="table">
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="title" placeholder="Product title">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn btn-primary" type="submit" name="submit" value="View">
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
                <a class="btn btn-primary" href="product/product_create" role="button">Create New Product</a>

            </div>
        </div>
    </div>

</body>

</html>