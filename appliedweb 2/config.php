<?php

$url = $_SERVER['REQUEST_URI'];

$filename = explode('/', $url);

$current_page = end($filename);

$dbserver = 'localhost';
$dbuser = 'clara';
$dbpass = 'clara';
$dbname = 'hungrybubbles';

?>