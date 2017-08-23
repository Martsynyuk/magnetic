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
$a3 = [
	'name' =>'',
	'age'=>'',
	'country' =>'',
	'city' =>'',
	'street' =>''
];

$file = fopen('../files/task8/example.csv', 'w');
fputcsv($file, array_keys($a3));
fputcsv($file, array_replace($a3, $a1));
fputcsv($file, array_replace($a3, $a2));
fclose($file);
