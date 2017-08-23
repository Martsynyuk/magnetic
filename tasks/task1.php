<?php

//Написати паттерн регулярного виразу, приклади коректної роботи паттерну приведені в табличці нижче

include_once 'home.php';

$mails = [
    'test.mail@mail.com',
    'abc-mail@host.ua',
    'user@site.net',
    'nomail@gmail.coma',
    '-mnk@mail.com',
    'mail@mail@mail.com',
    'mail*tt@mail.com'
];

$pattern = '/[^!-][a-zA-Z.-]@[!.coma]+/';

foreach ($mails as $mail) {
    var_dump(preg_match($pattern, $mail));
    if (preg_match($pattern, $mail) === 0) {
        echo 'mail ' . $mail . ' not valid </br>';
    };
}
