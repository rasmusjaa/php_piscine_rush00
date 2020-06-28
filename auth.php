<?php

include_once 'connect.php';

function auth($username, $password)
{
	$conn = connect_to_shop_mysql();
	$user = mysqli_real_escape_string($conn, $username);
	$hashed_pw = hash('sha256', 'suolaa' . $password);
	$sql = "SELECT * FROM users
		WHERE username='" . mysqli_real_escape_string($conn, $user) . "'
	 	AND password='" . mysqli_real_escape_string($conn, $hashed_pw) . "'";

	$result = mysqli_query($conn, $sql);
	$res = mysqli_num_rows($result);
	if ($res === 1)
		return TRUE;
	return FALSE;
}

?>
