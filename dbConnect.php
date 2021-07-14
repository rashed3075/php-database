<?php

function connect()
{
	$conn = new mysqli("localhost","rashed","123456","wtk");
	if($conn->connect_errno){
		die("Connection failed due to " .$conn->connect_error);
	}
	return $conn;


}

?>