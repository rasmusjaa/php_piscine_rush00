<?php

include_once 'products.php';

$name = $_POST['name'];
$price = floatval($_POST['price']);
$image = $_POST['image'];

if ($name != '' && $price > 0 && $image != '' && add_product($name, $price, $image))
	header('Location: admin.php?product=created');
else
	header('Location: admin.php?product=not_created');

?>
