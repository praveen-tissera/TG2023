<?php
//print_r($_GET);
print_r($_POST);

if ($_POST['password'] == $_POST['retypepassword']) {
    echo "Password Match";
} else {
    echo "Password Doesen't Match";
}
