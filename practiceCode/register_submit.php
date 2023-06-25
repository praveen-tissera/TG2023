<?php 
print_r($_POST);
echo $_POST['email'];

//connect to the database
//create a link to the database 
$connection=mysqli_connect('127.0.0.1', 'root','','user_db');
if ($connection){
    echo "Connected successfully"
}else{
    echo "database connection fails"
}
//insert data into the database
//table name, insert query


$query_string=""
//paste code 

echo $query_string;


mysqli_query($connection,$query_string);
?>