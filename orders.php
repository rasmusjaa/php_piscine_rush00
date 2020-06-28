<?php

include_once 'connect.php';

function get_orders() {
	$conn = connect_to_shop_mysql();
	$sql = "SELECT username, status, order_date, id FROM orders;";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$orders = [];
		while($row = mysqli_fetch_assoc($result)) {
			array_push($orders, $row);

		}
		foreach ($orders as $key => $order) {
			$sql = "SELECT op.quantity, p.name, p.price, p.id FROM products p
			JOIN order_products op ON op.product_id = p.id WHERE op.order_id = '". $order['id']. "';";
			$result = mysqli_query($conn, $sql);
			$products = [];
			while($row = mysqli_fetch_assoc($result)) {
				array_push($products, $row);
			}
			$total = 0;
			foreach ($products as $prod) {
				$total += $prod['price'];
			}
			$orders[$key]['products'] = $products;
			$orders[$key]['total'] = $total;
		}
		return $orders;
	} else {
		return ['error', 'error', 'error', 'error'];
	}

}

function add_order($username)
{
	$conn = connect_to_shop_mysql();

	$status = "pending";

	$sql = "INSERT INTO orders (username, status)
	VALUES ('" . $username . "', '" . $status . "')";

	if (mysqli_query($conn, $sql)) {
		$last_id = mysqli_insert_id($conn);
		echo "New order created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return $last_id;

	mysqli_close($conn);
}

function modify_order($id, $status) {
	$conn = connect_to_shop_mysql();

	$sql = "UPDATE orders SET status='" . $status . "' WHERE id='" . $id . "';";
   	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function remove_order($id) {
	$conn = connect_to_shop_mysql();

	$sql = "DELETE FROM orders WHERE id='" . $id . "';";
	$sql2 = "DELETE FROM order_products WHERE id='" . $id . "';";

	if (mysqli_query($conn, $sql)) {
	echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function add_product_to_order($order_id, $product_id, $qty) {
	$conn = connect_to_shop_mysql();

	$sql = "INSERT INTO order_products (product_id, order_id, quantity)
	VALUES ('" . $product_id . "', '" . $order_id . "', '" . $qty . "')";

	if (mysqli_query($conn, $sql)) {
		echo "New product added to order successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

?>

