<?php

// print_r($_GET);

print_r($_POST);




if($_POST['userpassword'] == $_POST['retypepassword']){

    echo "Password correct";

    //check password is match with retype password

    //pass email and password to the db and validate




    //

    $query = "SELECT COUNT(*) as userExist FROM `register_tbl` WHERE

    email='{$_POST['useremail']}' && password = '{$_POST['userpassword']}'";

   $connection = mysqli_connect('127.0.0.1','root', '', 'user_db');

   if($connection){

    echo "Connected Successfully";

   }else{

       echo "database connection fails";

   }




   $result = mysqli_query($connection,$query);




   //convert result into array from

   $result_in_array = mysqli_fetch_assoc($result);

   print_r($result_in_array);
   //if user exist
   if($result_in_array['userExist']==1){
    //redirecting to login page
    header('Location:form.php?message= email or password incorrect. Try again');
   }else{

   }

   //if user not exist

}else{

    echo "Password mismatch please try again";

}


