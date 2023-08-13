<?php
// operators

$number = 30;
$value = 300;

$total = $number + $value;
// comparison  ==, =>, <=, >, < 
echo !($number == $value);
echo ($value > $number);
// logical operators AND (&&),  OR(||) ,  NOT(!)
echo (($number == $value) || ($value > $number));
// arrays
$examHall = array();
$examHall[0] = 'Janith';
$examHall[1] = 'Nuwan';
// print
print_r($examHall);
var_dump($examHall);
// functions

function cal($value1, $value2){
// logic
$total = $value1 + $value2;
// echo 'total is ' . $total;
return $total;
}

echo 'result is ' . cal(100,300);
echo  'result is ' . cal(1000,300);

?>