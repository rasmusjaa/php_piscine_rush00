<?php

include_once 'connect.php';

function add_user($username, $password, $role)
{
	$conn = connect_to_shop_mysql();
	$user = mysqli_real_escape_string($conn, $username);
	$hashed_pw = hash('sha256', 'suolaa' . $password);

	$sql = "INSERT INTO users (username, password, role)
	VALUES ('" . $username . "', '" . $hashed_pw . "', '" . $role . "')";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function change_user_password($username, $password)
{
	$conn = connect_to_shop_mysql();
	$user = mysqli_real_escape_string($conn, $username);
	$hashed_pw = hash('sha256', 'suolaa' . $password);

	$sql = "UPDATE users SET password = '" . $hashed_pw . "'
		WHERE username = '" . $username . "'";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

?>