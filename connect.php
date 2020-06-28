<?php

function connect_to_shop_mysql()
{
	$servername = "localhost";
	$user = "root";
	$pw = "user42";
	$dbname = "shop";

	$conn = mysqli_connect($servername, $user, $pw, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}

?>
