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
    if (isset($_GET['message'])) {
        echo $_GET['message'];
    }

    ?>
    <form action="form_submit.php" method="post">
        <input type="email" name="email" placeholder="your email">
        <input type="password" name="password" placeholder="your password">
        <input type="password" name="retypepassword" placeholder="re-type your password">
        <input type="submit" name="login" value="Login">

    </form>
</body>

</html>