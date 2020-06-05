<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

if (isset($_POST['adduser'])) {
    $query = "INSERT INTO user (username, password, image, balance, permission)
            VALUES ('".$_POST['username']."','".md5($_POST['password'])."','','0','".$_POST['permission']."')";

    echo $query;
	
    $stmt = $db->prepare($query);
    $stmt->execute();
}

echo $query;

header("Location: adminpage.php");

?>