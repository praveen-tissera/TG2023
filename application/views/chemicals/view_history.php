<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Chemical History</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    $this->load->helper('array');
    ?>
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
    print_r($result);
    ?>

    <div class="container">
        <div class="row position-relative">
            <div class="col-12 position-static">


                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('chemiclas/view_history') ?>
                <table class="table">

                    <tr>
                        <td>Start date (YYYY-MM-DD)</td>
                        <td><input class="form-control" type="text" value='<?php echo $start_date ?>' name="start_date"></td>
                    </tr>
                    <tr>
                        <td>End Date (YYYY-MM-DD)</td>
                        <td><input class="form-control" type="text" value='<?php echo $end_date ?>' name="end_date"></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
                    </tr>

                </table>
                <?php echo form_close(); ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center;">Date</th>
                            <th scope="col" style="text-align:center;">1</th>
                            <th scope="col" style="text-align:center;">2</th>
                            <th scope="col" style="text-align:center;">3</th>
                            <th scope="col" style="text-align:center;">4</th>
                            <th scope="col" style="text-align:center;">5</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $date = $start_date;
                        while ($date <= $end_date) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo ($date); ?>
                                </th>

                            </tr>
                        <?php
                            $formated_date = date_create($date);
                            date_add($formated_date, date_interval_create_from_date_string("1 day"));
                            $date = date_format($formated_date, "Y-m-d");
                        }
                        ?>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center;">Date</th>
                            <th scope="col" style="text-align:center;">1</th>
                            <th scope="col" style="text-align:center;">2</th>
                            <th scope="col" style="text-align:center;">3</th>
                            <th scope="col" style="text-align:center;">4</th>
                            <th scope="col" style="text-align:center;">5</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $date = $start_date;
                        while ($date <= $end_date) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo ($date); ?>
                                </th>

                            </tr>
                        <?php
                            $formated_date = date_create($date);
                            date_add($formated_date, date_interval_create_from_date_string("1 day"));
                            $date = date_format($formated_date, "Y-m-d");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>