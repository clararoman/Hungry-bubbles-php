<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include('config.php');

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}
//a session is a type of cookie

//creates a file in a temporary directory on the server where registered session variables and their values are stored. A session ends when the user closes the browser or after leaving the site, the server will terminate the session after a predetermined period of time, commonly 30 minutes duration. 

//sessions get stored on the client as well as a server.
@ob_start();
session_start();


?>

 <html>
    <head>
        <title>Counting with the SESSION array</title>
    </head>
    <body>
        <FORM action="session.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
                session_start();
                if (!isset($_SESSION['counter']))
                    $count = 0;
                else
                    $count = $_SESSION['counter'];
                    $count = $count + 1;
                    $_SESSION['counter'] = $count;
                    echo "count is $count";
            ?>
        </FORM>

    </body>
</html>
