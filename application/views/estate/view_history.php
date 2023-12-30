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

                <?php echo form_open('estate/view_history') ?>
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
                            <th scope="col">Task</th>
                            <th scope="col">Colour</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">fertilizer</th>
                            <td class="table-success"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row">pesticide</th>
                            <td class="table-warning"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row">weedicide</th>
                            <td class="bg-danger"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row">harvest</th>
                            <td class="bg-success"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row">weeding</th>
                            <td class="bg-warning"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row">prune</th>
                            <td class="bg-info"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th scope="row">maintenance</th>
                            <td class="bg-primary"></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
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
                                <td class="<?php
                                            $i = 0;
                                            while ($i <= 4) {
                                                if (isset($result[$date][$i])) {
                                                    $result_array = get_object_vars($result[$date][$i]);
                                                    if ($result_array['id'] == 1) {
                                                        echo ($result_array['colour']);
                                                        break;
                                                    }
                                                }
                                                $i++;
                                            }
                                            ?>"></td>
                                <td class="<?php
                                            $i = 0;
                                            while ($i <= 4) {
                                                if (isset($result[$date][$i])) {
                                                    $result_array = get_object_vars($result[$date][$i]);
                                                    if ($result_array['id'] == 2) {
                                                        echo ($result_array['colour']);
                                                        break;
                                                    }
                                                }
                                                $i++;
                                            }
                                            ?>"></td>
                                <td class="<?php
                                            $i = 0;
                                            while ($i <= 4) {
                                                if (isset($result[$date][$i])) {
                                                    $result_array = get_object_vars($result[$date][$i]);
                                                    if ($result_array['id'] == 3) {
                                                        echo ($result_array['colour']);
                                                        break;
                                                    }
                                                }
                                                $i++;
                                            }
                                            ?>"></td>
                                <td class="<?php
                                            $i = 0;
                                            while ($i <= 4) {
                                                if (isset($result[$date][$i])) {
                                                    $result_array = get_object_vars($result[$date][$i]);
                                                    if ($result_array['id'] == 4) {
                                                        echo ($result_array['colour']);
                                                        break;
                                                    }
                                                }
                                                $i++;
                                            }
                                            ?>"></td>
                                <td class="<?php
                                            $i = 0;
                                            while ($i <= 4) {
                                                if (isset($result[$date][$i])) {
                                                    $result_array = get_object_vars($result[$date][$i]);
                                                    if ($result_array['id'] == 5) {
                                                        echo ($result_array['colour']);
                                                        break;
                                                    }
                                                }
                                                $i++;
                                            }
                                            ?>"></td>
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