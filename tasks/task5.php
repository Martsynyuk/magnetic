<?php

include_once 'home.php';

$a = [
    0 => 7,
    1 => 1,
    2 => 4,
    3 => 2,
    4 => 5
];

$triger = true;

while ($triger) {
    $triger = false;
    for ($i = 0; $i < count($a) - 1; $i++) {
        if ($a[$i] > $a[$i + 1]) {
            $a1 = $a[$i + 1];
            $a[$i + 1] = $a[$i];
            $a[$i] = $a1;
            $triger = true;
        }
    }
}

print_r($a);
