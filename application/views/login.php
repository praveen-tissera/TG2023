<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Login</title>

    
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col">
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
                <h1>Login Page</h1>
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                <?php echo form_open('login/loginSubmit') ?>
                <table class="table">
                    <tr>
                        <td>
                        <input class="form-control" type="text" name="email" placeholder="Login Email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input class="form-control" type="password" name="password" placeholder="Password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input class="btn btn-primary" type="submit" name="submit" value="Login">
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</body>
</html>
