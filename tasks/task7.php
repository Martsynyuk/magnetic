<?php

include_once 'home.php';

$handle = fopen('../files/tack7/example.csv', 'r');
$arr = fgetcsv($handle);

while (($line = fgetcsv($handle)) !== FALSE) {
    echo '<pre>';
    var_dump($line);
    echo '</pre>';
}
fclose($handle);