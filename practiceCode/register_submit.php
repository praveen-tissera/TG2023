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
$current_date = date("Y-m-d");
$query_string = "INSERT INTO `register_tbl` (`id`, `name`, `email`, `password`, `address`, `created_date`) VALUES (NULL, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}', '$current_date')";

echo $query_string;

$result = mysqli_query($connection, $query_string);
//if recorde added that count will return from  the mysqli_affected_rows query if its sail return -1 or npthing will happen will return 0

if(mysqli_affected_rows($connection)==1){
    echo "record added succesfully";


    header('location:register.php?message= record addded suceselfully');


}elseif(mysqli_affected_rows($connection)==-1){
    echo "error";

}elseif(mysqli_affected_rows($connection)==0){
    echo "nothing added into the database";
}
?>