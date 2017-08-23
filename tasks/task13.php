<?php

include_once 'home.php';

$sql = 'select c_name, p_name from categories as c 
		join associations as a ON c.c_id = a.c_id
		join products as p ON p.p_id = a.p_id';

echo $sql;


