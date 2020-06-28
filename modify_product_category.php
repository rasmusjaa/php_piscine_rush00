<?php

include_once 'products.php';

$product_id = $_POST['product_id'];
$category_id = $_POST['category_id'];

if ($product_id != '' && $category_id != '' && $_POST['mod'] == 'remove' && remove_product_from_category($product_id, $category_id))
	header('Location: admin.php?productcategory=removed');
else if ($product_id != '' && $category_id != '' && $_POST['mod'] == 'add' && add_product_to_category($product_id, $category_id))
	header('Location: admin.php?productcategory=added');
else
	header('Location: admin.php?productcategory=not_modified');
?>
