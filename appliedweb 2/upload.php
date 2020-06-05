<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include("config.php");


@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    exit();
  }




if (isset($_POST['submit'])) {

	$maxsize = 2096000;
	$allowed = array('jpg', 'jpeg','png','gif');

	$ext = strtolower(substr($_FILES['upload']['name'], strpos($_FILES['upload']['name'], '.')+1));

	$errors = array();

	if(in_array($ext, $allowed) === false){
		$errors[] = 'NOT AN ALLOWED EXTENSION';
	}

	if($_FILES['upload']['size'] > $maxsize){

		$errors[] = 'FILE TOO BIG';
	}

	if(empty($errors)){

		//$submitbtn = $_POST['submit'];
		$filename = $_FILES['upload']['name'];
		echo $_FILES['upload']['size'];
		echo "<br>";
		echo $filename;

		move_uploaded_file($_FILES['upload']['tmp_name'], 'uploaded/'.$filename);
		
		$query = "INSERT INTO gallery VALUES ('$filename', NOW())";
		echo $query;
		
		$stmt = $db->prepare($query);
    	$stmt->execute();

		//if (!empty($filename)) {
		//$target = GW_UPLOADPATH . $filename;

		//if (move_uploaded_file($_FILES['filename']['tmp_name'], $target)) {
				

				$query = "UPDATE user SET image = '$filename' WHERE username = 'clara'";
				mysqli_query($db, $query);

		//}
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Upload pictures</h1>
	<br>
<?php
	if(isset($errors)){
		if(empty($errors)){
			echo "upload successful";
		} else{
			foreach($errors as $err) {
				echo $err;
			}
		}
		
	}

// $query = "SELECT * FROM user";
// $data = mysqli_query($db, $query);

// echo '<table>';

// while ($row=mysqli_fetch_array($data)) {
// 	echo '<tr><td class="gallerytable">';
// 	echo '<span class="image"'.$row['image'].'</span><br/>';
// 	echo '</td>';
// 	if (is_file($row['image']) && filesize($row['image']) > 0) {
// 		echo '<td><img src="'.$filename.'" alt="image"/></td></tr>';
// 	}
// }
// echo '</table>';

// value="<?php if(!empty($filename)) echo $filename"
?>

<form enctype="multipart/form-data" method="post" action="">
	<label for="filename">Image upload:</label>
	<br/>
	<input type="file" name="upload" id="upload" />
	<br/>
	<input type="submit" value="upload image" name="submit">
</form>
</body>
</html>
