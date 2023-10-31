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
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Selected Product</h1>
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

                echo "<table class='table'>";
                foreach ($product_info as $key => $value) {
                    $img = base_url('images/food/'.$value->image);

                    echo "<tr>";
                    echo "<td>";
                    echo "Product ID";
                    echo "</td>";
                    echo "<td>";
                    echo $value->id;
                    echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Title";
                    echo "</td>";
                    echo "<td>";
                    echo $value->title;
                    echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Description";
                    echo "</td>";
                    echo "<td>";
                    echo $value->description;
                    echo "</td>";

                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>";
                    echo "Image";
                    echo "</td>";
                    echo "<td>";
                    //the image does not load
                    echo "<img src='$img' alt='Product Image' >";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Created Date";
                    echo "</td>";
                    echo "<td>";
                    echo $value->created_date;
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>

            </div>
        </div>
    </div>

</body>

</html>