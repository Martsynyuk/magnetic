<?php

include_once 'home.php';

$arrays = array_map('str_getcsv', file('../files/task7/example.csv'));
$head   = array_shift($arrays);
$res    = [];

foreach($arrays as $array) {
	$res[] = array_combine($head, $array);
}

var_dump($res);