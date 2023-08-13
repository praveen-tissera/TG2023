<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url().'css/bootstrap.min.css' ?>" />
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Register New User</h1>
        <form action="register_submit.php" method="post">
        <table class='table'>
            <tr>
                <td colspan="2">Register page</td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input class='form-control' type="text" name="name"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input class='form-control' type="text" name="email"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class='form-control' type="password" name="password"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <textarea class='form-control' name="address" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="btn-black" name="submit" value="Register"></td>
            </tr>

        </table>
    </form>
            </div>
</div>
    </div>
</body>
</html>
