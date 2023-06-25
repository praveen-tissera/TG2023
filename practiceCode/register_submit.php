<?php 
print_r($_POST);
echo $_POST['email'];

// connect to the databae
// create a link to Database
$connection = mysqli_connect('127.0.0.1','root', '', 'user_db');
if($connection){
 echo "Connected Successfully";
}else{
    echo "database connection fails";
}
// insert data into the database
// table name,  insert query
$current_date = date('Y-m-d');
$query_string = "INSERT INTO `register_tbl` (`id`, `name`, `email`, `password`, `address`, `created_date`) VALUES (NULL, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}', '$current_date')";

echo $query_string;

$result = mysqli_query($connection, $query_string);

if(mysqli_affected_rows($connection) == 1){
    echo "action successful";
    header('Location:register.php?message=action successful');
}else if(mysqli_affected_rows(($connection)) == 0){
    echo "no action took place";
}else if(mysqli_affected_rows($connection) == -1){
    echo "CRUD operation failure";
}
?>
