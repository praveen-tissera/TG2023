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
    <title>New Chemical</title>
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
                <h1>Register New Chemical</h1>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('chemicals/add_chemical_submit') ?>
                <table class="table">
                    <tr>
                        <td colspan="2">New Chemical</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input class="form-control" type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Type of Chemical</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="type" id="weedicide" autocomplete="off" value="weedicide">Weedicide
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="type" id="pesticide" autocomplete="off" value="pesticide">Pesticide
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="type" id="fertilizer" autocomplete="off" value="fertilizer">Fertilizer
                                </label>
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Add Chemical"></td>
                    </tr>

                </table>
                <?php echo form_close(); ?>

            </div>
        </div>

    </div>
    <script>
        $('.btn-group').button('toggle');
    </script>
</body>

</html>