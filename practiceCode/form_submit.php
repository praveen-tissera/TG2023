<?php
//print_r($_GET);
print_r($_POST);

if ($_POST['password'] == $_POST['retypepassword']) {
    echo "Password Match";
    //password is match with retype password
    //pass email and password to the db and validate

    //
    $query = "SELECT COUNT(*) as userExist FROM `register_tbl` WHERE email='{$_POST['useremail']}' &&
     password = '{$_POST['userpassword']}'";
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'user_db');
    if ($connection) {
        echo "Connected Successfully";
    } else {
        echo "database connection fails";
    }

    $result = mysqli_query($connection, $query);


    //convert result into array form
    $result_in_array = mysqli_fetch_assoc($result);
    print_r($result_in_array);

    //if user no exsit
    if($result_in_array['userExist'] == 1){
        header('location:profile.php')
    }else{
        // redirect to login page
        header('Location:form.php?message= email or password incorrect. try again');
    }
    //if user exist
} else {
    echo "Password Doesen't Match";
}
