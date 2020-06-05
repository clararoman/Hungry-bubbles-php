 <?php

 ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");
include("header.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

 unset($_SESSION['username']);
 header('Location: login.php');

 ?>