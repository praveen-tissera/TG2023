<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>One Day Report</title>
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
                <?php echo form_open('estate/one_day_report') ?>
                <table class="table">

                    <tr>
                        <td>Date (YYYY-MM-DD)</td>
                        <td><input class="form-control" type="text" value='<?php echo $date ?>' name="date"></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
                    </tr>

                </table>
                <?php echo form_close(); ?>
                <h3>Date </h3>
                <h4><?php echo ($date) ?></h4>
                <?php if (isset($work_done)) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Zone</th>
                                <th scope="col">Task</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($work_done as $key => $value) { ?>
                                <tr>
                                    <th scope="row"><?php echo ($value->id); ?></th>
                                    <td><?php echo ($value->id); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>