<?php
print_r($_POST);

if($_POST['password'] == $_POST['retypepass']){
    echo "success!";
}else{
    echo "password does not match";
}

?>