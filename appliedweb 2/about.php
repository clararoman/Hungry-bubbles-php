<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();

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
	<title>About us</title>
    <link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
    <?php include("config.php");?>
    <?php include("header.php");?>
<body>
<div class="headerImg page-n">
  <img src="styling/Img/hblogo.png" id="logo">
</div>
    	 <div id="bodycontent">
            <div id="bio">
                <div id="profilepics">
                  <img src="Styling/Img/sofia.jpg" id="sofiapic">
                  <img src="Styling/Img/clara.jpg" id="clarapic">
                </div>
                 <h2>Sofia and Clara</h2>
                 <p>We are second year students in New Media Design at Jönköping University. We have been working on this project since spring 2018 and it is our learning process into creating dynamic and user friendly web pages. The idea for hungry bubbles came from playing online games that are simple yet addictive! We both share a passion for learning new programming languages and currently we are working on learning the secrets of php. </p> 
            </div>
        </div>
   </body>
  <?php include("footer.php");?>
</html>