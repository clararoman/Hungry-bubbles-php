<?php
session_start();
//standard setup
ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");
include("header.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}


?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Namnlöst dokument</title>
<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
<body>
<div class="headerImg page-n">
  <img src="styling/Img/hblogo.png" id="logo">
</div>
<div id="adminpage_wrap">
<?php

	if($_SESSION['userPermission']!== '1') {
	echo 'you do not have the permission to access this page';
	header('location:index.php');
	}else{
	 
	    $query = "SELECT ball.name, ball.cost, ball.itemId, ball.isBought FROM ball";
		$stmt = $db->prepare($query);
		$stmt->bind_result($ballName, $ballCost, $ballid, $isBought);
		$stmt->execute();
		?>
		<div class="userInfo">
			<p>Logged in as user:
				<?php echo $_SESSION['username']; ?>
			</p>
			<br>
			<p>User type:
				<?php echo $_SESSION['userPermission']; ?>
			</p>
		</div>

		<div class="ballManage">
			<h3>Edit and delete</h3>
			
		<?php
		
		echo '<table>';
		echo '<tr class="trheader"><th>Ball Name</th> <th>Ball Cost</th> <th>Is bought</th></tr>';
		
		while ($stmt->fetch()) {
	    	
	    	echo "<tr>";
	   		echo "<td> $ballName </td><td> $ballCost </td><td> $isBought </td>";
	    	
	    		echo "<form method='get' action='edit.php'>
        				<td><input type='text' name='newname' id='newname'>
        				<button name='balledit' value='".$ballid."' type='submit'>Edit name</button></td>
	        			</form>";
	        			
	        	echo "<form method='get' action='delete.php'>
	        			<td><button name='ballremove' value='" . $ballid . "' type='submit'>Remove from store</button></td>
	        			</form>";
	        			
	    	
	    	echo "</tr>";
	    }
	    echo "</table>";
	}

?>
		</div> <!-- end ballmanage -->
		<div class="addnew">
			<h3>Add ball</h3>
			<form method="post" action="add.php">
			<p>Name:</p>
			<input type="text" name="ballName">
			<p>Cost</p>
			<input type="text" name="ballCost">
			<button name="addnew" type="submit">Add</button>
		</form>
		</div>

		<div class="adduser">
			<h3>Add user</h3>
			<form method="post" action="adduser.php">
			<p>Username:</p>
			<input type="text" name="username">
			<p>Password:</p>
			<input type="text" name="password">
			<p>Permission:</p>
			<input type="text" name="permission">
			<button name="adduser" type="submit">Add user</button>
		</form>
		</div>
	</div><!-- end of wrap -->
<script type="text/javascript" src="js/adminpage.js"></script>
</body>
</html>