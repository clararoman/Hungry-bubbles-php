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
	<title>Contact us</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
    <?php include("config.php");?>
    <?php include("header.php");?>
<body>
<div class="headerImg page-n">
  <img src="styling/Img/hblogo.png" id="logo">
</div>
<?php
	if (isset($_POST) && !empty($_POST)) {

		
		$email = mysqli_real_escape_string($db, trim($_POST['email']));
		$name = mysqli_real_escape_string($db, trim($_POST['name']));
		$msg = mysqli_real_escape_string($db, trim($_POST['message']));
	
		//$to = 'sofia.flankkumaki@gmail.com';
		//$subject = 'Contact from Hungry Bubbles ' .$name;
		//mail($to, $subject, $msg, 'From:' . $email);
		if (!empty($email) && !empty($name) && !empty($msg)) {
	
		echo 'Your email was sent. Thanks for contacting us, we will be in touch.';
		
		}else{
			echo "<div>Please fill all fields</div>";}
		
		}

?>


<h1>Contact us</h1>
<form action="contact.php" method="post">
	<label for="firstname">Name:</label>
		<input type="text" id="name" name="name" /><br/><br/>
	<label for="email">Email:</label>
		<input type="text" id="email" name="email" /><br /><br/>
	<label for="message">Type your message here:</label> <textarea id="message" name="message"></textarea><br />
		<input type="submit" value="Send message" name="submit" />
</form>
  </body>
  <?php include("footer.php");?>
</html>