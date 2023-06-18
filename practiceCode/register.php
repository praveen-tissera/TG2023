<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>

<body>
    <form action="register_submit.php" method="post">
        <table border="2">
            <tr>
                <td colspan="2">Register Page </td>

            <tr>
                <td>Name</td>
                <td> <input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td> <input type="text" name="name"></td>
            </tr>
            <tr>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Adress</td>
                <td> <textarea name="adress" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="register"></td>
            </tr>
        </table>
    </form>
</body>

</html>