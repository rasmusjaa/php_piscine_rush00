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


function get_categories() {
	$conn = connect_to_shop_mysql();

	$res;
	$sql = "SELECT name, id FROM categories;";
    $result = $conn->query($sql);

	if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo '<div class="category">
		<div class="category_name">'
		.$row["name"].
		'</div></div>';
	}
	} else {
	echo "0 results";
	}
	mysqli_close($conn);
}

?>
