<?php 

$created_date = date('Y-m-d');

$connection = mysqli_connect('localhost', 'root', '', 'user_db');

if(!$connection){
    echo '<br>connection is not established.<br>';
}

$query_string = "INSERT INTO `register_tbl` (`id`, `name`, `email`, `password`, `address`, `created_date`) 
                 VALUES (NULL, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}', '{$_POST['address']}',
                 '{$created_date}')";

$result = mysqli_query($connection, $query_string);

switch(mysqli_affected_rows($connection)){
    case 1:
        echo "record added successfully"; 
        header('Location:register.php?message=record added successfully');
        break;
    case 0:
        echo "no record added"; 
        header('Location:register.php?message=no record added');
        break;
    case -1:
        echo "error";
        header('Location:register.php?message=error');
        break;
    default:
        echo "records added successfully";
        header('Location:register.php?message=records added successfully');
        break;
}

?>