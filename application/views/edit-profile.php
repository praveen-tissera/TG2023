<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Profle</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>My Profile</h1>
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
                echo form_open('user/editProfileSubmit');
                echo "<table class='table'>";
                $userId = 0;
                foreach ($myprofile as $key => $value) {
                    // print_r($value->id);
                    $userId = $value->id;
                    echo "<input type='hidden' name='userid' value='{$value->id}'>";
                    echo "<tr>";
                    echo "<td>";
                    echo "User ID";
                    echo "</td>";
                    echo "<td>";
                    echo $value->id;
                    echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "User Name";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->name}' name='username'>";

                    echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Email";
                    echo "</td>";
                    echo "<td>";
                    echo "<input class='form-control' type='text' value='{$value->email}' name='email'>";

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

                    echo "<tr>";
                    echo "<td>";
                    echo "Registerd Date";
                    echo "</td>";
                    echo "<td>";
                    echo $value->created_date;
                    echo "</td>";
                    echo "</tr>";
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