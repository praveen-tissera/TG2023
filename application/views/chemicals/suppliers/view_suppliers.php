<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Suppliers</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Chemicals</h1>
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
                foreach ($result as $key => $value) {
                    echo "<table class='table'>";

                    echo "<tr>";
                    echo "<td>";
                    echo "<h3>";
                    echo "Name";
                    echo "</h3>";
                    echo "</td>";
                    echo "<td>";
                    echo "<h3>";
                    echo $value->name;
                    echo "</h3>";
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
                    echo "Adress";
                    echo "</td>";
                    echo "<td>";
                    echo $value->address;
                    echo "</td>";
                    echo "</tr>";

                  
                ?>

                    <?php
                    echo "</table>";
                    if ($this->session->userdata('routing')['profile']['edit']) { ?>
                        <a class="btn btn-primary" href="<?php echo base_url() . '/chem_supplier/edit_supplier/' . $value->supplier_id ?>" role="button">Edit Supplier</a>
                        <a class="btn btn-warning" href="<?php echo base_url() . '/chem_supplier/delete_supplier/' . $value->supplier_id ?>" role="button">Delete Supplier</a>
                <?php }
                }
                ?>



            </div>
        </div>
    </div>

</body>

</html>