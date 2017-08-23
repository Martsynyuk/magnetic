<?php

include_once 'home.php';

$hostname = 'localhost';
$user = 'terr';
$password = '290483';
$database = 'task14';

$connect = new mysqli($hostname, $user, $password, $database)
or die('Could not connect: ' . mysqli_connect_errno());

$sql = 'SELECT c.c_name, p.P_name FROM categories as c
        JOIN associations as a ON c.c_id = a.c_id
        JOIN products as p ON p.p_id = a.p_id';

$query = $connect->query($sql);
$file = fopen('../tasks/task14/example.csv', 'w');

while($row = $query->fetch_assoc()) {
	fputcsv($file, $row);
}

fclose($file);
