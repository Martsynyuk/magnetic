<?php

include_once 'home.php';

$a1 = [
  'name' => 'some name',
  'age' => 5,
  'city' => 'some town'
];
$a2 = [
  'age' => 6,
  'country' => 'small country',
  'city' => 'mego city',
  'street' => 'cute ave.'
];

$list = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
);

$fp = fopen('file.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);