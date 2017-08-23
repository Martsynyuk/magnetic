<?php

include_once 'home.php';

$files   = scandir('../files/task6');
$pattern = '/[^0-9]/';

foreach ($files as $file) {
	if (preg_replace($pattern, '', $file) > 9) {
		echo $file . '</br>';
	}
}


