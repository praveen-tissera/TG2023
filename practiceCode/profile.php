<?php 
session_start();
echo $_SESSION['userEmail'];
if(!isset($_SESSION['userEmail'])){
    header('Location:form.php?message= Your are not authorized to veiw profile page please login first !!');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
            <li>Home</li>
            <li><a href="profile.php">profile</a></li>
            <li><a href="logout.php"> logout</a></li>
        </ul>
    </nav>
    <h1>Profle</h1>

    <?php
        // SELECT * FROM `register_tbl` WHERE email = 'nuwan@gmail.com';
        $connection = mysqli_connect('127.0.0.1', 'root', '', 'user_db');
        $query = "SELECT * FROM `register_tbl` WHERE email = '{$_SESSION['userEmail']}'";
        $result = mysqli_query($connection,$query);
        $result_array = mysqli_fetch_assoc($result);
        print_r($result_array);
        
    
    ?>
    
</body>
</html>