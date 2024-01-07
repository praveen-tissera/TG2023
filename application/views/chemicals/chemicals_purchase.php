<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap-select.min.css' ?>">
    <title>Add Work</title>
</head>

<body>
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
                <h1>Add chemicals Purchased</h1>
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php echo form_open('chemicals/add_chemicals_submit') ?>
                <table class="table">
                    <tr>
                        <td>Chemical Name</td>
                        <td>
                            <select class="selectpicker" name="chem_id" data-live-search="true" multiple title="Please select an Option">
                                <?php
                                foreach ($chemicals as $key => $value) {
                                    echo "<option value='$value->chem_id'>$value->name</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>OR</td>
                        <td>
                            <a class="btn btn-success" href="<?php echo base_url() . '/chemicals/add_chemicals/'  ?>" role="button">Add new Chemical</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Amount(Liters/Kg)</td>
                        <td>
                            <input type="text" class="form-control" name="amount" id="new_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Cost</td>
                        <td>
                            <input type="text" class="form-control" name="cost" id="new_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td>
                            <select class="selectpicker" name="supplier_id" data-live-search="true" multiple title="Please select an Option">
                                <?php
                                foreach ($suppliers as $key => $value) {
                                    echo "<option value='$value->supplier_id'>$value->name</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>OR</td>
                        <td><a class="btn btn-success" href="<?php echo base_url() . '/estate/add_supplier/'  ?>" role="button">Add new Supplier</a></td>
                    </tr>

                    <tr>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
                    </tr>
                </table>
                <?php echo form_close(); ?>


            </div>
        </div>

    </div>
    <script>
        $('.btn-group').button('toggle');
    </script>
    <script>
        $('.selectpicker').selectpicker();
    </script>

    <script src="<?php echo base_url() . '/js/jquery-3.2.1.slim.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/jquery-ui.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/popper.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/bootstrap-select.min.js' ?>"></script>
    <script src="<?php echo base_url() . '/js/defaults-*.min.js' ?>"></script>

</body>

</html>