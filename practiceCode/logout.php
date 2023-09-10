<?php
<<<<<<< HEAD
    session_start();
    if(isset($_SESSION['userEmail'])){
        session_destroy();
        header('Location:form.php?message=logout succesfully. try again');
    }
=======
 session_start();
 if(isset($_SESSION['userEmail'])){
    session_destroy();
    header('Location:form.php?message=Logout successfully');
 }
?>
>>>>>>> main
