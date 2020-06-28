<?php

session_start();
include_once 'orders.php';
include_once 'products.php';
//add_products_to_order();
if ($_SESSION['basket']) {

    $products = array_count_values($_SESSION['basket']);
    $id = add_order($_SESSION['logged_on_user']);
    foreach($products as $item => $quantity) {
        print_r($products);
        echo $item;
        $product = get_product($item);
        add_product_to_order($id, $product[1], $quantity);
    }
}
$_SESSION['basket'] = null;
header('Location: basket.php?order=success');

?>
