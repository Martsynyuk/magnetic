<?php

include_once 'home.php';

$string = 'певна стрічка';

/**
 * @param $string
 */
function translit ($string) {
    $converter = [
        'п' => 'p',
        'е' => 'e',
        'в' => 'v',
        'н' => 'n',
        'а' => 'a',
        'с' => 's',
        'т' => 't',
        'р' => 'r',
        'і' => 'i',
        'ч' => 'ch',
        'к' => 'k',
    ];

    return strtr($string, $converter);
}

echo translit($string);