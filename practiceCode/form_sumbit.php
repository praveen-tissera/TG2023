<?php
//print_r($_GET)
print_r($_POST);
if($_POST['userpassword'] == $_POST['retypepassword']){
echo "passward matches";
}else{
echo "password not matches ";
}
