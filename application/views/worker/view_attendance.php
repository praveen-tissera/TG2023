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
    $this->load->view('/common/carousel.php');
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
    ?>

    <div class="container">
        <div class="row position-relative">
            <div class="col-12 position-static">


                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('worker/view_attendance') ?>
                <table class="table">

                    <tr>
                        <td>Start date </td>
                        <td><input class="form-control" type="date" value='<?php echo $start_date ?>' name="start_date"></td>
                    </tr>
                    <tr>
                        <td>End Date </td>
                        <td><input class="form-control" type="date" value='<?php echo $end_date ?>' name="end_date"></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
                    </tr>

                </table>
                <?php echo form_close(); ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center;">Date</th>
                            <?php foreach ($worker as $key => $value) { ?>
                                <th scope="col" style="text-align:center;"><?php echo ($value->name) ?> </th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $date = $start_date;
                        while ($date <= $end_date) {
                            $count = count($result[$date]);
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo ($date); ?>
                                </th>
                                <?php foreach ($worker as $key => $value) { ?>
                                    <td class="<?php
                                                $i = 0;
                                                while ($i < $count) {
                                                    if ($result[$date][$i]->worker_id == $value->worker_id) {
                                                        $status = ($result[$date][$i]->status);
                                                        break;
                                                    }
                                                    $i++;
                                                }
                                                if (isset($status)) {
                                                    if ($status == 1) {
                                                        echo ("bg-success");
                                                    } else {
                                                        echo ("bg-danger");
                                                    }
                                                }
                                                $status = NULL;
                                                ?>"> </td>
                                <?php } ?>
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
    <?php
    $this->load->view('/common/footer.php');
    ?>
</body>

</html>