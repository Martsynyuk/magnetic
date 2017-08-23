<?php

include_once 'home.php';

$a1 = ['e1', 'ab', 'cd'];
$a2 = ['y5', 'y6', 'y7'];

$a2 = array_reverse($a2);
$res = [];

foreach ($a1 as $key => $val) {
    $res[] = $a1[$key] . '-' . $a2[$key];
}

var_dump($res);