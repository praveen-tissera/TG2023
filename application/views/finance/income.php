<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap-select.min.css' ?>">
    <title>Income</title>
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
                <h1>Add Income</h1>
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php echo form_open('finance/income_submit') ?>
                <table class="table">
                    <tr>
                        <td>Income Type</td>
                        <td>
                            <select class="selectpicker" name="source" data-live-search="true" multiple title="Please select an Option">
                                <?php
                                foreach ($bal as $key => $value) {
                                    echo "<option value='$value->id'>$value->type</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Income Source</td>
                        <td>
                            <select class="selectpicker" name="type_id" data-live-search="true" multiple title="Please select an Option">
                                <?php
                                foreach ($result as $key => $value) {
                                    echo "<option value='$value->type_id'>$value->name</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>OR</td>
                        <td>
                            <a class="btn btn-success" href="<?php echo base_url() . 'finance/add_income_type'  ?>" role="button">Add new Income</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Amount</td>
                        <td>
                            <input type="text" class="form-control" name="amount">
                        </td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td>
                            <textarea class="form-control" name="comments" cols="30" rows="10"></textarea>
                        </td>
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