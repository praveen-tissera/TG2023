<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/css/bootstrap.min.css"> 
    
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

        <?php require_once('navigation.php') ?>
<?php 
    if(isset($_GET['message'])){
        echo $_GET['message'];
    }
   
    ?>
    
    <form action="form_submit.php" method="post">
        <input type="email" name="useremail" value="example@gmail.com" placeholder="your email">
        <input type="password" name="userpassword" placeholder="password">
        <input type="password" name="retypepassword" placeholder="retype password">
        <input type="submit" name="login" value="Login" >
    </form>

        </div>
    </div>
</div>



]
</body>
</html>