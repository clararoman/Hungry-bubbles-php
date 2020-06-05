<?php

// require_once('authorize.php');


ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

if (isset($_GET['ballremove'])) {
    $ballid = $_GET['ballremove'];
    $query = "DELETE FROM ball
            WHERE itemId = '".$ballid."'";

    echo $query;
	
    $stmt = $db->prepare($query);
    $stmt->execute();
}

echo $query;

header("Location: adminpage.php"); /* Redirect browser */
exit();


?>