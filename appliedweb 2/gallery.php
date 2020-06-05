<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();

include("config.php");
require_once("filepath.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit(); 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
   
<body>

	<?php include("header.php");?>
		
	<h1>Gallery</h1>
	
	<?php
			
	$query = "SELECT * FROM gallery";
	$image = mysqli_query($db, $query);

	

	while ($div = mysqli_fetch_array($image)) {
		

		
		echo '<img class="galleryimg" height="100px" src=Uploaded/'. $div['filename'] . '>';
	
	}

		
		
	?>
	
</body>