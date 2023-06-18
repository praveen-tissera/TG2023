<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration form</title>
</head>

<body>
    <div class="box" style="display: flex; align-items: center; justify-content: center; width: auto; height: 500px;">
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
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea name="text" cols="30" rows="10" style=""></textarea></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="p" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Register" name="submit"></td>
                </tr>
            </table>
        </form>

    </div>
</body>

</html>