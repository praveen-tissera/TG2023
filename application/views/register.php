<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">

    <title>Register</title>

</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h1>Register New User</h1>

                
                    <?php echo form_open('login/registerSubmit')?>
                    <table class="table">



                        <tr>

                            <td>Name</td>

                            <td><input type="text" name="name" class="form-control"></td>

                        </tr>

                        <tr>

                            <td>Email</td>

                            <td><input type="text" name="email" class="form-control"></td>

                        </tr>

                        <tr>

                            <td>Password</td>

                            <td><input type="password" name="password" class="form-control"></td>

                        </tr>

                        <tr>

                            <td>Address</td>

                            <td>

                                <textarea name="address" cols="30" rows="10" class="form-control"></textarea>

                            </td>

                        </tr>

                        <tr>

                            <td></td>

                            <td><input  class="btn btn-primary" type="submit" name="submit" value="Register" class="form-control"></td>

                        </tr>
                    </table>
               <?php echo form_close();?>

            </div>

        </div>

    </div>

</body>

</html>