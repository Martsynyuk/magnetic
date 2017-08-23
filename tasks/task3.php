<?php

//Вивести відсортований масив [PHP, arrays]

include_once 'home.php';

$a1 = [7, 1, 4, 2, 5];
$a2 = ['a11', 'a3', 'a22', 'a1'];

sort($a1);

var_dump($a1);
var_dump($a2);
