<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

if (isset($_POST['addnew'])) {
    $query = "INSERT INTO ball (name, img, cost, isBought)
            VALUES ('".$_POST['ballName']."','','".$_POST['ballCost']."','0')";

    echo $query;
	
    $stmt = $db->prepare($query);
    $stmt->execute();
}

echo $query;

header("Location: adminpage.php");

?>