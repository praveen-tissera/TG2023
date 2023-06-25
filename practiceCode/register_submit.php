<?php 
print_r($_POST);
echo $_POST["email"]

// connect to the database
// create a link to Database
$connection = mysql_connect('127.0.0.1','root','','user_db');
if($connection){
    echo "Connected Successfully";
}else{
    echo "database connection fails";
}
// insert data into the database
// table name, insert query

$query_string = "INSERT INTO 'register_tbl' ('id', 'name', 'email', 'password', 'addres', 'created_date') VALUES (NUll, '{$_post['name']}', '{$_post['email']}', '{$_post['password']}', '{$_post['address']}', '2023-06-18')";

echo $query_string;

mysqli_query($connection, $query_string);
?>