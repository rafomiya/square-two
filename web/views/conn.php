<?php
$server = getenv("SERVER");
$user = getenv("USER");
$dbname = getenv("DBNAME");
$password = getenv("PASSWORD");

$pdo = new PDO('mysql:dbname='.$dbname.';host='.$server, $user, $password);
?>
