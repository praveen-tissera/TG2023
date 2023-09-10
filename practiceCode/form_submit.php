<?php
// print_r($_GET);
print_r($_POST);

if ($_POST['userpassword'] == $_POST['retypepassword']) {
    echo "Password correct";
<<<<<<< HEAD
    // check password is match with retype password
    // pass email and password to the db and validate

    //
    $query = "SELECT COUNT(*) as userExist FROM `register_tbl` WHERE email='{$_POST['useremail']}' && password='{$_POST['userpassword']}'";
    require_once('connection.php');
    if($connection){
        echo "Connected Successfully";
    }else{
=======
    // check password is match with retype password 
    //pass email and password to the db and validate

    // 
    $query = "SELECT COUNT(*) as userExist FROM `register_tbl` WHERE email='{$_POST['useremail']}' && password = '{$_POST['userpassword']}'";
    require_once('connection.php');
    if ($connection) {
        echo "Connected Successfully";
    } else {
>>>>>>> main
        echo "database connection fails";
    }

    $result = mysqli_query($connection, $query);

<<<<<<< HEAD
    // convert result into  array form
    $result_in_array = mysqli_fetch_assoc($result);
    print_r($result_in_array);
    // if user exist
    if($result_in_array['userExist'] == 1){
        //start session
        session_start();
        // insert some unique value to the session array
        $_SESSION['userEmail'] = $_POST['useremail'];
        header('Location:profile.php');
=======
    // convert result into array form
    $result_in_array = mysqli_fetch_assoc($result);
    // print_r($result_in_array);
    // if user  exit
    if($result_in_array['userExist'] == 1){
        // start session
        session_start();
        // insert some unique value to the session array 
        $_SESSION['userEmail'] = $_POST['useremail'];
         echo $_SESSION['userEmail'];
     header('Location:profile.php');  
>>>>>>> main
    }else{
        // redirect to login page
        header('Location:form.php?message= email or password incorrect. try again');
    }

    //if user exist
<<<<<<< HEAD

}else{
=======
} else {
>>>>>>> main
    echo "Password mismatch please try again";
}
