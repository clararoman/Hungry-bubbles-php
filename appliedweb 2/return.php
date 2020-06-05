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

if (isset($_POST['returnBall'])) {

        $invId = $_POST['returnBall'];
        $invItemId = $_POST['invItemId'];
        echo "$invItemId";

        $query = "UPDATE ball SET stock = stock + 1 WHERE ball.itemId = ".$invItemId;
        echo "$query";
    

        $stmt = $db->prepare($query);
        $stmt->execute();

        
        $query = "DELETE FROM inventory WHERE invId = ".$invId;


        $stmt = $db->prepare($query);
        $stmt->execute();

        header('location:items.php');

    }
 ?>