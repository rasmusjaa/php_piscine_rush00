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

function modify_user($username, $role) {
	$conn = connect_to_shop_mysql();
	$user = mysqli_real_escape_string($conn, $username);

	$sql = "UPDATE users SET role='" . $role . "' WHERE username='" . $user . "';";
   	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function remove_user($username) {
	$conn = connect_to_shop_mysql();
	$user = mysqli_real_escape_string($conn, $username);

	$sql = "DELETE FROM users WHERE username='" . $user . "';";

	if (mysqli_query($conn, $sql)) {
	echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function get_users() {
	$conn = connect_to_shop_mysql();

	$sql = "SELECT username, id, role FROM users;";
    $result = mysqli_query($conn, $sql);
	$users = [];
	if (mysqli_num_rows($result) > 0) {

	while($row = mysqli_fetch_assoc($result)) {

		array_push($users, $row);
	}
		return ($users);
	} else {
	echo "0 results";
	}
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

function get_user_role($username)
{
	$conn = connect_to_shop_mysql();

	$sql = "SELECT role FROM users
		WHERE username = '" . $username . "';";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$role = $row["role"];
	} else
	{
		$role = '';
	}
	mysqli_close($conn);
	return $role;
}

?>
