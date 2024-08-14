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
    print_r($incomes);
    print_r($expenses);
    print_r($current);
    ?>

    <div class="container">
        <div class="row position-relative">
            <div class="col-12 position-static">


                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('finance/view_tran_history') ?>
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
                            <th scope="col" style="text-align:center;">Source </th>
                            <th scope="col" style="text-align:center;">Type</th>
                            <th scope="col" style="text-align:center;">Comments</th>
                            <th scope="col" style="text-align:center;">Image</th>
                            <th scope="col" style="text-align:center;">Amount</th>
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
                                        foreach ($current as $x => $curr) {
                                            if ($curr->id == $value->source) {
                                                echo ($curr->type);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($incomes as $x => $in) {
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
                            <?php foreach ($result["out"][$date] as $key => $value) { ?>
                                <tr class="table-danger">
                                    <th scope="row">
                                        <?php echo ($date); ?>
                                    </th>
                                    <td>
                                        <?php
                                        foreach ($current as $x => $curr) {
                                            if ($curr->id == $value->source) {
                                                echo ($curr->type);
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($expenses as $x => $exp) {
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