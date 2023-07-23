<?php 
print_r($_POST);
echo $_POST['email'];

// connect to the databae
// create a link to Database
<<<<<<< HEAD
$connection = mysqli_connect('127.0.0.1','root', '', 'user');
=======
$connection = mysqli_connect('127.0.0.1','root', '', 'user_db');
>>>>>>> 138772f712e4014c242eb385c0da58f35e1036cc
if($connection){
 echo "Connected Successfully";
}else{
    echo "database connection fails";
}
// insert data into the database
// table name,  insert query
<<<<<<< HEAD
$current_date=date('Y-m-d');
$query_string = "INSERT INTO `register_tbl` (`id`, `name`, `email`, 
`password`, `address`, `created_date`) VALUES (NULL, '{$_POST['name']}', 
'{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}', 
'$current_date')";

echo $query_string;
$result=mysqli_query($connection, $query_string);
//if the records added that count will be returned from the mysqli_affected_rows query if it fails, it returns -1 or if nothing happened the return will be 0
if (mysqli_affected_rows($connection)==1){
    echo "record added successfully";
    header('Location:register.php?message=record added successfully');
} else if (mysqli_affected_rows($connection)==-1) {
    echo "error";
}else if (mysqli_affected_rows($connection)==0){
    echo "nothing is added to the database";
}
mysqli_query($connection, $query_string);
=======
$current_date = date('Y-m-d');
$query_string = "INSERT INTO `register_tbl` (`id`, `name`, `email`, `password`, `address`, `created_date`) VALUES (NULL, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}', '$current_date')";

echo $query_string;

$result = mysqli_query($connection, $query_string);
// if recorde added that count will be return from the mysqli_affected_rows query if its fail return -1 or nothing happen will return 0

if(mysqli_affected_rows($connection) == 1){
    echo "recorde added successfully";

    header('Location:register.php?message= record added successfully');

}else if(mysqli_affected_rows($connection) == -1){
    echo "error";
    
}else if(mysqli_affected_rows($connection) == 0){
    echo "nothing added into the database";
}
>>>>>>> 138772f712e4014c242eb385c0da58f35e1036cc
?>