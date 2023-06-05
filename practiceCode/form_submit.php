<?php
//print_r($_GET);
print_r($_POST);

if ($_POST['user_password'] == $_POST['retyped_password']) {
    echo "Password Success";
} else {
    echo "Failed try again";
}
