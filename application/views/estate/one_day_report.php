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
    $this->load->view('/common/carousel.php');
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
                echo validation_errors('<div class="alert alert-danger">', '</div>');
                ?>
                <h1>One Day Report</h1>
                <?php echo form_open('estate/one_day_report') ?>
                <table class="table">

                    <tr>
                        <td>Date</td>
                        <td><input class="form-control" type="date" value='<?php echo $date ?>' name="date"></td>
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
                                    <td><?php echo ($value->status); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if (isset($weather)) { ?>
                    <h3>Weather</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Relative Humidity</th>
                                <th scope="col">Max Tempreture</th>
                                <th scope="col">Min Tempreture</th>
                                <th scope="col">Daylight Duration</th>
                                <th scope="col">Rain Sum</th>
                                <th scope="col">Max Wind Speed</th>
                                <th scope="col">Wind Direction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($weather as $key => $value) { ?>
                                <tr>
                                    <td><?php echo ($value->relative_humidity); ?></td>
                                    <td><?php echo ($value->max_temp); ?></td>
                                    <td><?php echo ($value->min_temp); ?></td>
                                    <td><?php echo ($value->daylight_duration); ?></td>
                                    <td><?php echo ($value->rain_sum); ?></td>
                                    <td><?php echo ($value->max_wind_speed); ?></td>
                                    <td><?php echo ($value->wind_direction); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>

                <?php if (isset($attendance)) { ?>
                    <h3>Attendance</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <?php foreach ($worker as $key => $value) { ?>
                                    <th scope="col" style="text-align:center;"><?php echo ($value->name) ?> </th>
                                <?php }
                                $count = count($attendance);
                                ?>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php foreach ($worker as $key => $value) { ?>
                                    <td class="<?php
                                                $i = 0;
                                                while ($i < $count) {
                                                    if ($attendance[$i]->worker_id == $value->worker_id) {
                                                        $status = ($attendance[$i]->status);
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
                        </tbody>
                    </table>
                <?php } ?>
                <?php if (isset($fin_info)) { ?>
                    <h3>Financial Transaction</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">Source </th>
                                <th scope="col" style="text-align:center;">Type</th>
                                <th scope="col" style="text-align:center;">Comments</th>
                                <th scope="col" style="text-align:center;">Image</th>
                                <th scope="col" style="text-align:center;">Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($fin_info["in"] as $key => $value) { ?>
                                <tr class="table-success">
                                    <td>
                                        <?php
                                        foreach ($fin_current as $x => $curr) {
                                            if ($curr->id == $value->source) {
                                                echo ($curr->type);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($fin_types["in"] as $x => $in) {
                                            if ($in->type_id == $value->type_id) {
                                                echo ($in->name);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->comments);
                                        ?>
                                    </td>
                                    <td>
                                        <img class="img" alt="Income reference" src="<?php echo base_url() . '/uploads/image/income/' . $value->image ?>" height="40" width="auto">
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->amount);
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php foreach ($fin_info["out"] as $key => $value) { ?>
                                <tr class="table-danger">
                                    <td>
                                        <?php
                                        foreach ($fin_current as $x => $curr) {
                                            if ($curr->id == $value->source) {
                                                echo ($curr->type);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($fin_types["out"] as $x => $exp) {
                                            if ($exp->type_ID == $value->type_ID) {
                                                echo ($exp->name);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->comments);
                                        ?>
                                    </td>
                                    <td>
                                        <img class="img" alt="Expense reference" src="<?php echo base_url() . '/uploads/image/expense/' . $value->image ?>" height="40" width="auto">
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->amount);
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <?php } ?>

                <?php if (isset($chem_info)) { ?>
                    <h3>Chemical Transactions</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">Chemical</th>
                                <th scope="col" style="text-align:center;">Amount</th>
                                <th scope="col" style="text-align:center;">Cost</th>
                                <th scope="col" style="text-align:center;">Supplier</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($chem_info["in"] as $key => $value) { ?>
                                <tr class="table-success">
                                    <td>
                                        <?php
                                        foreach ($chem_types as $x => $chem) {
                                            if ($chem->chem_id == $value->chem_id) {
                                                echo ($chem->name);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->amount);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->cost);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($suppliers as $x => $sup) {
                                            if ($sup->supplier_id == $value->supplier) {
                                                echo ($sup->name);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php foreach ($chem_info["out"] as $key => $value) { ?>
                                <tr class="table-danger">
                                    <td>
                                        <?php
                                        foreach ($chem_types as $x => $chem) {
                                            if ($chem->chem_id == $value->chem_id) {
                                                echo ($chem->name);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo ($value->amount);
                                        ?>
                                    </td>
                                    <td></td>
                                    <td><?php
                                        foreach ($suppliers as $x => $sup) {
                                            if ($sup->supplier_id == $value->supp_id) {
                                                echo ($sup->name);
                                                break;
                                            }
                                        }
                                        ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    $this->load->view('/common/footer.php');
    ?>
</body>

</html>