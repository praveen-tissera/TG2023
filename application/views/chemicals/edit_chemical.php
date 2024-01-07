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
    <title>Edit Chemical</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Chemical</h1>
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
                <?php
                print_r($this->session->userdata('userinfo'));
                // print_r($myprofile);
                echo form_open('chemicals/editChemicalSubmit');
                echo "<table class='table'>";
                foreach ($result as $key => $value) {

                    echo "<input type='hidden' name='chem_id' value='{$value->chem_id}'>";
                    echo "<tr>";
                    echo "<td>";
                    echo "Name";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->name}' name='name'>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Chemical ID";
                    echo "</td>";
                    echo "<td>";
                    echo $value->chem_id;
                    echo "</td>";
                    echo "</tr>";
                ?>

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

                    <?php
                    echo "<tr>";
                    echo "<td>";
                    echo "Description";
                    echo "</td>";
                    echo "<td>";
                    echo "<textarea class='form-control' name='description'>";
                    echo $value->description;
                    echo "</textarea>";
                    echo "</td>";
                    echo "</tr>";

                    ?>
                <?php
                }
                echo "</table>";
                echo "<input type='submit' class='btn btn-success' value='Update'>";
                echo form_close();
                ?>

            </div>
        </div>
    </div>
    <script>
        $('.btn-group').button('toggle');
    </script>

</body>

</html>