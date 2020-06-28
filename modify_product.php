<?php

include_once 'products.php';

$name = $_POST['name'];
$newname = $_POST['newname'];
$price = floatval($_POST['price']);
$image = $_POST['image'];

if ($name != '' && isset($_POST['remove']) && remove_product($name))
	header('Location: admin.php?product=removed');
else if ($name != '' && $newname != '' && $price > 0 && $image != '' && modify_product($name, $newname, $price, $image))
	header('Location: admin.php?product=modified');
else
	header('Location: admin.php?product=not_modified');
?>
