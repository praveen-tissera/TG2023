<?php 
print_r($_POST);
echo $_POST["email"];
// connect to the database
// create a link to Database
require_once('connection.php');
// insert data into the database
// table name, insert query
$current_date = date('Y-m-d');
$query_string = "INSERT INTO `register_tbl` (`id`, `name`, `email`, `password`, `address`, `created_date`) VALUES (NUll, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}', '$current_date')";

echo $query_string;

$result = mysqli_query($connection, $query_string);
// if recorde added that count will be return from the mysqli_affected_rows query if its fail return -1 or nothing happen will return 0

if(mysqli_affected_rows($connection) == 1){
    echo"recorde added successfully";

    header('Location:register.php?message= record added successfully');

}else if(mysqli_affected_rows($connection) == -1){
    echo"error";

}else if(mqli_affected_rows($connection) == 0){
    echo"nothing added into the database";
}


?>