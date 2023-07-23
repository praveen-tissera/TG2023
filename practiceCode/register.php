<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<body>
<<<<<<< HEAD
    <?php
    if (isset($GET['message'])) {
            echo $_GET['message'];
    }
=======
    <?php 
    if(isset($_GET['message'])){
        echo $_GET['message'];
    }
   
>>>>>>> 138772f712e4014c242eb385c0da58f35e1036cc
    ?>
    <form action="register_submit.php" method="post">
        <table border="2">
            <tr>
                <td colspan="2">Register page</td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <textarea name="address" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Register"></td>
            </tr>

        </table>
    </form>
</body>

</html>