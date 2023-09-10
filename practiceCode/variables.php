<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        
        $_2new_t8 = 100;
        $value = 300;
        $name = 'Nuwan';
        echo '<h1>Welcome $name to my PHP class</h1>';
        echo "<h1>Welcome $name to my PHP class</h1>";
        echo '<br>';
        echo $name;
        $fname = $name;
        $name = 'Gayan';

        // constant variable

        define('IP','127.0.0.1');
        echo IP;
        define('IP', 'adfasf');

        // Arrays
        $names = Array();
        $names[0] = 'Nuwan';
        $names[1] = 'Gayan';
        print_r($names[1]);

    ?>
</body>
</html>