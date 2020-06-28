<?php

include_once 'connect.php';

function add_order($username)
{
	$conn = connect_to_shop_mysql();

	$status = "pending";

	$sql = "INSERT INTO orders (username, status)
	VALUES ('" . $username . "', '" . $status . "')";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

/* function add_product_to_order */

?>

