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
            $myusername = mysqli_real_escape_string($db, trim($_POST['username']));
            $mypassword = mysqli_real_escape_string($db, trim($_POST['password']));

            
            $query = "SELECT username, password, permission, playerId FROM user WHERE username = '$myusername' AND " . "password = '$mypassword'";
    
            

            $data = mysqli_query($db, $query);

        
            //while($stmt->fetch()){

            if (mysqli_num_rows($data) == 1){ 

                $row = mysqli_fetch_assoc($data);
                    
                $_SESSION['userId'] = $row['playerId'];
                $_SESSION['userPermission'] = $row['permission'];
                $_SESSION['username'] = $myusername;

                        if($row['permission'] == 1){
                            header('location:adminpage.php');
                        }
                        else if($row['permission'] == 2){
                            header('location:moderator.php');
                        }

                }else{
                    echo "<div id='loginResult'>Username or password is incorrect</div>";
                }

            }
            // } end of while stmt fetch
    

?>
    <div id="loginbox">
       <form id="loginForm" name="login" action="login.php" method="post">
        <p class="lab username">Username:</p>
        <input type="text" name="username">
        <br>
        <p class="lab password">Password:</p>
        <input type="password" name="password">
        <br>
        <button id="loginBtn" type="submit">log in</button>

        <a id="logoutBtn" href="logout.php">log out</a>
    </form> 
    </div>

</body>
</html>
