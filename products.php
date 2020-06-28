<?php

include_once 'connect.php';

function add_product($name, $price, $image)
{
	$conn = connect_to_shop_mysql();

	$sql = "INSERT INTO products (name, price, image)
	VALUES ('" . $name . "', '" . $price . "', '" . $image . "')";

	if (mysqli_query($conn, $sql)) {
		echo "New product created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function modify_product($name, $newname, $price, $image) {
	$conn = connect_to_shop_mysql();

	$sql = "UPDATE products SET name='" . $newname . "', price='" . $price . "', image='" . $image . "'
		WHERE name='" . $name . "';";
   	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function remove_product($name) {
	$conn = connect_to_shop_mysql();

	$sql = "DELETE FROM products WHERE name='" . $name . "';";

	if (mysqli_query($conn, $sql)) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function add_product_to_category($product_id, $category_id) {
	$conn = connect_to_shop_mysql();

	$sql = "INSERT INTO product_categories (product_id, category_id)
	VALUES ('" . $product_id . "', '" . $category_id . "')";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function remove_product_from_category($product_id, $category_id) {
	$conn = connect_to_shop_mysql();

	$sql = "DELETE FROM product_categories WHERE product_id='" . $product_id . "' AND category_id='" . $category_id . "';";

	if (mysqli_query($conn, $sql)) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function get_product($id) {
	$conn = connect_to_shop_mysql();
	$protecc_id = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT name, id, image, price FROM products WHERE id = $protecc_id;";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$product = mysqli_fetch_row($result);
		return $product;
	} else {
		return ['error', 'error', 'error', 'error'];
	}
}

function get_products($all = false) {
	$conn = connect_to_shop_mysql();
	if ($all || $_SESSION['filter'] === 'all categories' || !$_SESSION['filter']) {
		$sql = "SELECT name, id, image, price FROM products;";
	} else {
		$protecc_filter = mysqli_real_escape_string($conn, $_SESSION['filter']);
		$sql = "SELECT p.name, p.id, p.image, p.price FROM products p
		JOIN product_categories pc ON pc.product_id = p.id
		JOIN categories c ON pc.category_id = c.id WHERE c.name = '".$protecc_filter."';";
	}
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	// output data of each row
	$products = [];
	while($row = mysqli_fetch_assoc($result)) {
		array_push($products, $row);
		}
		return ($products);
	} else {
	echo "0 results";
	}
	mysqli_close($conn);
}

?>
