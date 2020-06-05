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

if(isset($_SESSION['userId'])){

    $query = "SELECT ball.name, ball.img, ball.itemId, user.playerId, inventory.invId, inventory.itemId 
    FROM ball
    JOIN inventory ON ball.itemId = inventory.itemId
    JOIN user on user.playerId = inventory.playerId
    WHERE user.playerId = ".$_SESSION['userId'];

    $stmt = $db->prepare($query);
    $stmt->bind_result($ballName, $ballImg, $ballid, $playerid,$invId, $invItemId);
    $stmt->execute();

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Your items</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
    <?php include("config.php");?>
    <?php include("header.php");?>
<body>
<div class="headerImg page-n">
  <img src="styling/Img/hblogo.png" id="logo">
</div>
	<h2>MY ITEMS</h2>
<?php
if(isset($_SESSION['userId'])){

    echo "<ul class='inventory'>";
    while ($stmt->fetch()) {

        echo "<li class='invItem'>";
        echo "<h3> $ballName </h3><img src='styling/img/$ballImg'>";
        echo "<h4>Inventory id: $invId</h4>";
        echo "<h4>inventory item id: $invItemId </h4>";
        echo "<form method='post' action='return.php'>";
        echo "<input type='hidden' name='invItemId' value='$invItemId'/>";
        echo "<button name='returnBall' value='$invId' type='submit'>Return ball</a>";
        echo "</form>";
        echo "</li>";
    }
    echo "</ul>";
}else{
    echo "you have to be logged in to see your items";
}

?>
</body>
  <?php include("footer.php");?>
</html>