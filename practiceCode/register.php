<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>



<body>
    <?php
    if(isset($_GET['message'])){
        $script = "<script>alert('{$_GET['message']}')<script>";
        echo $script;
    }
    ?>
    <form action="register_submit.php" method="post">
        <table border="2">

            <tr>

                <td colspan="2">Register Page</td>

            </tr>




            <tr>

                <td>Name</td>

                <td><input type="text" name="name"></td>

            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>




            <tr>

                <td>Email</td>

                <td><input type="text" name="email"></td>

            </tr>





            <tr>

                <td>Address</td>

                <td>

                    <textarea name="address" cols="10" rows="10"></textarea>

                </td>

            </tr>




            <tr>

                <td></td>

                <td><input type="submit" name="submit" value="register"></td>

            </tr>



        </table>
    </form>
</body>

</html>