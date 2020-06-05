<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

if (isset($_POST['input_username']) && isset($_POST['input_username'])){
    $user_username = trim($_POST['input_username']);
    $user_password = trim($_POST['input_password']);
    $query = "SELECT username, password FROM user 
	WHERE username = '$user_username' 
	AND password = '$user_password'";

}

$stmt = $db->prepare($query);
$stmt->bind_result($username, $password);
$stmt->execute();

echo "Username: ".$username . " Password: " . $password;

?>
