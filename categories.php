<?php

include_once 'connect.php';

function add_category($name)
{
	$conn = connect_to_shop_mysql();

	$sql = "INSERT INTO categories (name)
	VALUES ('" . $name . "')";

	if (mysqli_query($conn, $sql)) {
	echo "New record created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function rename_category($name, $newname)
{
	$conn = connect_to_shop_mysql();

	$sql = "UPDATE categories SET name='" . $newname . "' WHERE name='" . $name . "';";

	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function remove_category($name)
{
	$conn = connect_to_shop_mysql();

	$sql = "DELETE FROM categories WHERE name='" . $name . "';";

	if (mysqli_query($conn, $sql)) {
	echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function get_categories()
{
	$conn = connect_to_shop_mysql();

	$sql = "SELECT name, id FROM categories;";
    $result = mysqli_query($conn, $sql);
	$categories = [];
	if (mysqli_num_rows($result) > 0) {

	while($row = mysqli_fetch_assoc($result)) {

		array_push($categories, $row);
	}
		return ($categories);
	} else {
	echo "0 results";
	}
	mysqli_close($conn);
}

?>
