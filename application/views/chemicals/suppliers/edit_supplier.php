<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Edit Supplier</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Supplier</h1>
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
                echo form_open('chem_supplier/edit_supplier_submit');
                echo "<table class='table'>";
                foreach ($result as $key => $value) {

                    echo "<input type='hidden' name='supplier_id' value='{$value->supplier_id}'>";
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
                    echo "Supplier ID";
                    echo "</td>";
                    echo "<td>";
                    echo $value->supplier_id;
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Address";
                    echo "</td>";
                    echo "<td>";
                    echo "<textarea class='form-control' name='address'>";
                    echo $value->address;
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
</body>

</html>