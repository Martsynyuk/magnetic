<?php

include_once 'home.php';

$a1 = [7, 1, 4, 2, 5];
$a2 = ['a11', 'a3', 'a22', 'a1'];

sort($a1);
var_dump($a1);

function getNumber($num)
{
    $pattern = '/[^0-9]/';
    return preg_replace($pattern, '', $num);
}

for ($i=0; $i <count($a2); $i++) {
    $next = $a2[$i];
    
    for ($j = $i - 1; $j >= 0 && getNumber($a2[$j]) > getNumber($next); $j--) {
        $a2[$j + 1] = $a2[$j];
    }
    $a2[$j + 1] = $next;
}

var_dump($a2);
