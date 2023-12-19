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
                <h1>Add the work done today</h1>

                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('estate/add_work_submit') ?>
                <table class="table">
                    <tr>
                        <td>Zone</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="zone" id="zone_1" autocomplete="off" value="1">Zone 1
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="zone" id="zone_2" autocomplete="off" value="2">Zone 2
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="zone" id="zone_3" autocomplete="off" value="3">Zone 3
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="zone" id="zone_4" autocomplete="off" value="4">Zone 4
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="zone" id="zone_5" autocomplete="off" value="5">Zone 5
                                </label>
                            </div>
                        </td>
                    
                    <tr>
                        <td>Task</td>
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary">
                                    <input type="radio" name="task" id="fertilizer" autocomplete="off" value="fertilizer">fertilizer
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="task" id="pesticide" autocomplete="off" value="pesticide">pesticide
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="task" id="weedicide" autocomplete="off" value="weedicide">weedicide
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="task"id="harvest" autocomplete="off" value="harvest">harvest
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="task" id="weeding" autocomplete="off" value="weeding">weeding
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="task" id="prune" autocomplete="off" value="prune">prune
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="task" id="maintenance" autocomplete="off" value="maintenance">maintenance
                                </label>
                            </div>
                        </td>
                    </tr>
                    </tr>
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
</body>

</html>