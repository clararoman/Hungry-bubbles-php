	<?php
	
	session_start();
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

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styling/style.css">
</head>
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
			echo "<div id='loginResult'>Please fill all fields</div>";}
		
		}
	?>
	
</body>
</html>