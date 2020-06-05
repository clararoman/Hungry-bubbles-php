<?php
session_start();
//standard setup
ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Store</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
 </head>
 <body>

<?php

if(isset($_SESSION['username'])){

	if (isset($_GET['buyBall'])) {



	        $ballid = $_GET['buyBall'];
	        $query = "
	        INSERT INTO inventory (invId, playerId, itemId)
	        VALUES (null,".$_SESSION['userId'].", ".$ballid.")";


	        $stmt = $db->prepare($query);
	        $stmt->execute();

	        $query = "UPDATE ball SET stock = stock-1 WHERE ball.itemId = ".$ballid;
	    

	        $stmt = $db->prepare($query);
	        $stmt->execute();

	        header('location:store.php');

	    }
	}else{
		echo "<h2>you need to be logged in to buy something</h2>";
		echo "<h4 class='buy link'><a href='login.php'>Log in</a></h4>";
	}
 ?>
 </body>
 </html>