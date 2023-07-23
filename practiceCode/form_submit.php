<?php 
// print_r($_GET);
print_r($_POST);

if($_POST['userpassword'] == $_POST['retypepassword']){
    echo "Password correct";

}else{
    echo "Password mismatch please try again";
}
// 
$query="SELTECT COUNT(*) as UserExist FROM 'register_tbl' WHERE email='{$_POST['useremail']}' && password='$_POST['"