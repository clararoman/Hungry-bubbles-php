<?php
require_once('authorize.php');

ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
}

$query = "SELECT ball.name, ball.cost, ball.id, ball.isBought FROM ball";


// $stmt = $db->prepare($query);
// $stmt->bind_result($ballName, $ballCost, $ballid, $isBought);
// $stmt->execute();

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Namnlöst dokument</title>
</head>

<body>
<?php
echo '<table bgcolor="dddddd" cellpadding="6">';
echo '<tr class="trheader"><td>Ball Name</td> <td>Ball Cost</td> <td>Is bought</td></tr>';
while ($stmt->fetch()) {
    echo "<tr>";
    echo "<td> $ballName </td><td> $ballCost </td><td> $isBought </td>";
    echo "<form method='get' action='delete.php'>
        <td><button name='ballremove' value='" . $ballid . "' type='submit'>Remove from store</button></td>
        </form>";
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>