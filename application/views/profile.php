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
                    if(isset($success)){
                        echo "<div class='alert alert-success'>";
                        echo $success;
                        echo "</div>";
                    }
                    if(isset($error)){
                        echo "<div class='alert alert-danger'>";
                        echo $error;
                        echo "</div>";
                    }
                    
                ?>
                <?php 
                    print_r($this->session->userdata('userinfo'));
                    // print_r($myprofile);

                    echo "<table class='table'>";
                   $userId = 0;
                    foreach ($myprofile as $key => $value) {
                        // print_r($value->id);
                        $userId = $value->id;
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
                        echo $value->name;
                        echo "</td>";

                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>";
                    echo "Email";
                    echo "</td>";
                    echo "<td>";
                    echo $value->email;
                    echo "</td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td>";
                echo "Address";
                echo "</td>";
                echo "<td>";
                echo $value->address;
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
                ?>
                <?php 
                    print_r($this->session->userdata('routing'));
                    if($this->session->userdata('routing')['profile']['edit']){ ?>
                        <a href="<?php echo base_url().'/login/editProfile/'.$userId ?>">Edit Profile</a>
                    <?php } ?>
              
                
            </div>
        </div>
    </div>
    
</body>
</html>