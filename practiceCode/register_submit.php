<?php

print_r($_POST);
echo $_POST('Email');

//connect to database
$connection = mysqli_connect('127.0.0.1','root', '', 'user_db');
if($connection){
echo "Connected Succesfully";
}else{
    echo "Databse connection fail"
}

//insert data into the database
//table name, insert query

$query_string = ""

echo $query_string;

mysqli_query($connection, $query_string)

?>