<?php 

//this is something that jasmin wrote when helping us with debugging. It basically just displays all the errors, so you know what in your code to look at.
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();

//basic include function, before everything loads. The config file is what provides the database connection with username, password, server, etc. Everything so that it can "log in" to our server and access the databases we made in phpMyAdmin.
include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname); //these four variables are defined in the config-file, and makes it possible for our code to connect/ "log in" to our database and make changes.

//this prints out what kind of error you get, but doesn't specify exactly what in the code is the source of the error. This code block just creates a string prior to the error state to make it more readable.
if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit(); //not sure why we need this, we can research on it
}

$searchItem = ""; //starting of with emptying the search bar, so it automatically erases at every page load (the page loads every time you klick "search", since this button has the type "submit", which is a built in feature that refreshes the page on click.)

if (isset($_GET['ballid'])) { //this basically means that, if the form with the method GET, and the name "ballid" is activated, the following happens. In our case, this form is really is just a button (the "buy"-button). SO this means, when you klick the "buy"-button.
    
    $ballid = $_GET['ballid']; //gets the ball id, so whe know which ball to do the following on:
    $query = "UPDATE ball 
            SET isBought=1
            WHERE itemId = ".$ballid; //updates the status of the ball, so "isBought" is 1. Later, this helps us when we place balls in "our items". 
	echo $query; //this just echos out the query, mostly for debugging purposes.
	
    //i know what these two are here for, but not the specifics of their function. We can look into that. But what I know is that they pretty much prepare the query that we created above, so the database can handle it, and then we execute the query to actually make it do something.

    $stmt = $db->prepare($query);
    $stmt->execute();

}

if (isset($_POST) && !empty($_POST)) { //if the form with the method POST is activated (the button is pressed), and is not empty, do this:
    $searchItem = trim($_POST['item']);

}

$query = "SELECT name, img, itemId, isBought, stock FROM ball";

if ($searchItem) {
    $query = $query . " WHERE name LIKE '%" . $searchItem . "%'"; //this is a SQL-string. It is actually what happens behind the scenes when you change anything in phpMyAdmin (adding tables, removing tables, etc. For us to make changes in our databases from our code, we need to write it in SQL.)
}

// echo $query;

$stmt = $db->prepare($query);
$stmt->bind_result($ballName, $ballImg, $ballid, $isBought, $ballstock);
$stmt->execute();


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Store</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
   <?php include("config.php"); ?>
    <?php include("header.php");?>
<body>
<div class="headerImg page-n">
  <img src="styling/Img/hblogo.png" id="logo">
</div>
    <div id="storeCont">
        <h2>Store</h2>
        <form id="search" action="" method="post">
        <input type="text" name="item" id="item">
        <button type="submit">Search</button>
    </form>
<?php 
echo "<ul class='store'>";
while ($stmt->fetch()) {

    echo "<li class='storeItem'>";
    echo "<h3> Name: $ballName </h3><img src='styling/img/$ballImg'>";
    echo "<h4>In stock: $ballstock </h4>";
    echo "<form method='get' action='buy.php'>";
    if ($ballstock > 0) {
        echo "<button name='buyBall' value='".$ballid."' type='submit'>Get</button>";
    }else{
        echo "<h5> This product is out of stock </h5>";
    }
    
    echo "</form>";
    echo "</li>";
}
echo "</ul>"; 

?>
</div>
    
 </body>
  <?php include("footer.php");?>
</html>