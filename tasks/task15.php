<?php

include_once 'home.php';

$query = "delete from table where id in (select max(id) from table group by name having count(id)>1)";

echo $query;