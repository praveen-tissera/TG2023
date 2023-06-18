<?php 
print_r($_POST);

$connection = mysqli_connect('localhost', 'root', '', 'user_db');

if($connection){
    echo '<br>connection established.';
}

$query_string = "INSERT INTO `user_details` (`ID`, `Name`, `Email`, `Password`, `Address`) 
                 VALUES (NULL, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}')";

echo $query_string."<br>";

mysqli_query($connection, $query_string);

?>