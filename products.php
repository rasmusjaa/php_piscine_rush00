<?php

include_once 'connect.php';

function add_product($name, $price, $image)
{
	$conn = connect_to_shop_mysql();

	$sql = "INSERT INTO products (name, price, image)
	VALUES ('" . $name . "', '" . $price . "', '" . $image . "')";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully<br />";
	} else {
		echo "Error: " . $sql . mysqli_error($conn) . "<br />";
		return FALSE;
	}
	return TRUE;

	mysqli_close($conn);
}

function get_products() {
	$conn = connect_to_shop_mysql();

	$res;
	$sql = "SELECT name, id, image, price FROM products;";
	// $result = $conn->query($sql);
	$result = mysqli_query($conn, $sql);

	// if ($result->num_rows > 0) {
	if (mysqli_num_rows($result) > 0) {
	// output data of each row
	// while($row = $result->fetch_assoc()) {
	while($row = mysqli_fetch_assoc($result)) {
		echo '<div class="product">
		<div class="product_name">'
		.$row["name"].
		'</div>'.
		'<img class="product_img" src="'. $row["image"]. '" />
		<div class="product_info">
			<span class="product_price">
				$'.$row["price"].'
			</span>
		</div>
		</div>';
		}
	} else {
	echo "0 results";
	}
	mysqli_close($conn);
}

/* function add_category_to_product */


?>
