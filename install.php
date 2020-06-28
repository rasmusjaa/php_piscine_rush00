<?php

include_once 'products.php';
include_once 'orders.php';
include_once 'categories.php';
include_once 'connect.php';
include_once 'users.php';

define("ADMIN", "0");
define("USER", "1");

$servername = "localhost";
$user = "root";
$pw = "user42";
$dbname = "shop";

// Create database
$conn = mysqli_connect($servername, $user, $pw);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;

if (mysqli_query($conn, $sql))
echo "Database created successfully<br />";
else
echo "Error creating database: " . mysqli_error($conn) . "<br />";

mysqli_close($conn);


// Create tables
$conn = connect_to_shop_mysql();

$table = "users";

$sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(256) NOT NULL UNIQUE,
	password VARCHAR(256) NOT NULL,
	role VARCHAR(2) NOT NULL,
	reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)";

if (mysqli_query($conn, $sql)) {
	echo "Table " . $table . " created successfully<br />";
} else {
	echo "Error creating table " . $table . ": " . mysqli_error($conn) . "<br />";
}

$table = "products";

$sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(256) NOT NULL UNIQUE,
	price FLOAT(10, 2) NOT NULL,
	image TEXT NOT NULL
	)";

if (mysqli_query($conn, $sql)) {
	echo "Table " . $table . " created successfully<br />";
} else {
	echo "Error creating table " . $table . ": " . mysqli_error($conn) . "<br />";
}

$table = "categories";

$sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(256) NOT NULL UNIQUE
	)";

if (mysqli_query($conn, $sql)) {
	echo "Table " . $table . " created successfully<br />";
} else {
	echo "Error creating table " . $table . ": " . mysqli_error($conn) . "<br />";
}

$table = "product_categories";

$sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
	product_id INT(6) UNSIGNED,
	category_id INT(6) UNSIGNED,
	FOREIGN KEY (product_id) REFERENCES products (id),
	FOREIGN KEY (category_id) REFERENCES categories (id),
	UNIQUE(product_id, category_id)

)";

if (mysqli_query($conn, $sql)) {
	echo "Table " . $table . " created successfully<br />";
} else {
	echo "Error creating table " . $table . ": " . mysqli_error($conn) . "<br />";
}

$table = "orders";

$sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(256) NOT NULL,
	status VARCHAR(256) NOT NULL,
	order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)";

if (mysqli_query($conn, $sql)) {
	echo "Table " . $table . " created successfully<br />";
} else {
	echo "Error creating table " . $table . ": " . mysqli_error($conn) . "<br />";
}

$table = "order_products";

$sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
	product_id INT(6) UNSIGNED,
	order_id INT(6) UNSIGNED,
	quantity INT(6) UNSIGNED,
	FOREIGN KEY (product_id) REFERENCES products (id),
	FOREIGN KEY (order_id) REFERENCES orders (id),
	UNIQUE(product_id, order_id)
	)";

if (mysqli_query($conn, $sql)) {
	echo "Table " . $table . " created successfully<br />";
} else {
	echo "Error creating table " . $table . ": " . mysqli_error($conn) . "<br />";
}

mysqli_close($conn);
echo "<br />Database structure ready<br /><br />";


// Insert row data

$username = "admin";
$password = "admin";
$role = ADMIN;
add_user($username, $password, $role);

$username = "user42";
$password = "user42";
$role = USER;
add_user($username, $password, $role);

echo "<br />Users ready: admin and user42<br /><br />";

$name = "frisbeegolf";
add_category($name);

$name = "volleyball";
add_category($name);

$name = "football";
add_category($name);

$name = "ball games";
add_category($name);



echo "<br />Categories ready: frisbeegolf, volleyball, football and ball games<br /><br />";


$name = "Adidas Football";
$price = 12.95;
$image = "./images/football_adidas.jpg";
add_product($name, $price, $image);

$name = "Nike Football";
$price = 13.95;
$image = "./images/football_nike.jpg";
add_product($name, $price, $image);

$name = "Black frisbee";
$price = 9.95;
$image = "./images/frisbee_black.jpg";
add_product($name, $price, $image);

$name = "Orange frisbee";
$price = 10.95;
$image = "./images/frisbee_orange.jpg";
add_product($name, $price, $image);

$name = "White frisbee";
$price = 11.95;
$image = "./images/frisbee_white.jpg";
add_product($name, $price, $image);

$name = "Yellow frisbee";
$price = 12.95;
$image = "./images/frisbee_yellow.jpg";
add_product($name, $price, $image);

$name = "Mikasa volleyball";
$price = 9.95;
$image = "./images/volleyball_mikasa.jpg";
add_product($name, $price, $image);

$name = "Wilson volleyball";
$price = 19.95;
$image = "./images/volleyball_wilson.jpg";
add_product($name, $price, $image);

echo "<br />Products ready: Adidas Football, Nike Football, Black frisbee, Orange frisbee, White frisbee, Yellow frisbee, Mikasa volleyball, Wilson volleyball<br /><br />";

add_product_to_category(1, 3);
add_product_to_category(2, 3);

add_product_to_category(3, 1);
add_product_to_category(4, 1);
add_product_to_category(5, 1);
add_product_to_category(6, 1);

add_product_to_category(7, 2);
add_product_to_category(8, 2);

add_product_to_category(1, 4);
add_product_to_category(2, 4);
add_product_to_category(7, 4);
add_product_to_category(8, 4);

// 1 frisbeegolf
// 2 volleyball
// 3 football
// 4 ball game

// 1 Adidas Football
// 2 Nike Football
// 3 Black frisbee
// 4 Orange frisbee
// 5 White frisbee
// 6 Yellow frisbee
// 7 Mikasa volleyball
// 8 Wilson volleyball

echo "<br />Products categorized<br /><br />";


$name = "user42";
add_order($username);


/*
sessioniin basket
	product, price, quantity
	total cost
	validation button

if logged in show validation button, else login box

admin section (if user role admin)
	show orders (delete or confirm?)
	add, modify, remove products
	add, modify, remove product-categories
	add, remove users, change user role

*/

?>

