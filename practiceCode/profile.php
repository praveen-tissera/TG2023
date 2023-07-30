<?php 
session_start();
echo $_SESSION['userEmail'];
if(!isset($_SESSION['userEmail'])){
    header('Location:form.php?message= Your are not authorized to veiw profile page please login first !!');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php require_once('navigation.php') ?>
    <h1>Profle</h1>

    <?php
        // SELECT * FROM `register_tbl` WHERE email = 'nuwan@gmail.com';
        require_once('connection.php');
        $query = "SELECT * FROM `register_tbl` WHERE email = '{$_SESSION['userEmail']}'";
        $result = mysqli_query($connection,$query);
        $result_array = mysqli_fetch_assoc($result);
        print_r($result_array);

        // show content in html table

        echo "<table border='1'>";
            echo "<tr>";
                echo "<td>";
                    echo "Name";
                echo "</td>";
                echo "<td>";
                    echo $result_array['name'];
                echo "</td>";
                
            echo "</tr>";

            echo "<tr>";
                echo "<td>";
                    echo "Email";
                echo "</td>";
                echo "<td>";
                    echo $result_array['email'];
                echo "</td>";
                
            echo "</tr>";

            echo "<tr>";
                echo "<td>";
                    echo "Address";
                echo "</td>";
                echo "<td>";
                    echo $result_array['address'];
                echo "</td>";
                
            echo "</tr>";

            echo "<tr>";
                echo "<td>";
                    echo "Register Date";
                echo "</td>";
                echo "<td>";
                    echo $result_array['created_date'];
                echo "</td>";
                
            echo "</tr>";
        echo "</table>";
        
    
    ?>

    
</body>
</html>