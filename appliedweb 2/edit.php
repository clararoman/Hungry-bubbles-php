<?php



ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

if (isset($_GET['balledit'])) {
    $ballid = $_GET['balledit'];
    $query = "UPDATE ball SET name ='".$_GET['newname']."' WHERE ball.itemId = ".$ballid;
	
    $stmt = $db->prepare($query);
    $stmt->execute();
}

echo $query;

header("location:adminpage.php"); /* Redirect browser */
exit();


?>