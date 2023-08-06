
<?php
 session_start();
 if(isset($_SESSION['userEmail'])){
    session_destroy();
    header('Location:form.php?message=Logout successfully');
 }
?>