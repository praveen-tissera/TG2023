<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <script src="<?php echo base_url() . '/js/jquery-3.2.1.slim.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/jquery-ui.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/popper.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/bootstrap.min.js' ?>"></script>
    <title>Add type</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
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
                <h1>Register New Income</h1>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('finance/add_income_type_submit') ?>
                <table class="table">
                    <tr>
                        <td colspan="2">New Income</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input class="form-control" type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Add Income Type"></td>
                    </tr>

                </table>
                <?php echo form_close(); ?>

            </div>
        </div>

    </div>
</body>

</html>