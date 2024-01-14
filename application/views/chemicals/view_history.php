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
    print_r($chemicals);
    print_r($suppliers);
    ?>

    <div class="container">
        <div class="row position-relative">
            <div class="col-12 position-static">


                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('chemicals/view_history') ?>
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
                            <th scope="col" style="text-align:center;">Chemical</th>
                            <th scope="col" style="text-align:center;">Amount</th>
                            <th scope="col" style="text-align:center;">Cost</th>
                            <th scope="col" style="text-align:center;">Supplier</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $date = $start_date;
                        while ($date <= $end_date) {
                        ?>
                            <?php foreach ($result["in"][$date] as $key => $value) { ?>
                                <tr class="table-success">
                                    <th scope="row">
                                        <?php echo ($date); ?>
                                    </th>
                                    <td>
                                        <?php
                                        foreach ($chemicals as $x => $chem) {
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
                            <?php foreach ($result["out"][$date] as $key => $value) { ?>
                                <tr class="table-danger">
                                    <th scope="row">
                                        <?php echo ($date); ?>
                                    </th>
                                    <td>
                                        <?php
                                        foreach ($chemicals as $x => $chem) {
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
                                    <td></td>
                                </tr>
                            <?php } ?>
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