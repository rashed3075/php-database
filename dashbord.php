
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashbord</title>
</head>
<body>
<?php
session_start();
	if(!isset($_SESSION['userName'])){
		header("location: login.php");
	}
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$userName = $_SESSION['userName'];
	?>
<h1><?php echo "Welcome ".$fname ." " .$lname; ?></h1>

</body>
</html>