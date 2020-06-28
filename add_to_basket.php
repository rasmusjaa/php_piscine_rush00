<?php
    session_start();
    if (!$_SESSION['basket']) {
        $_SESSION['basket'] = [];
    }
    $current_items = $_SESSION['basket'];
    array_push($current_items,$_POST['addToBasket']);
    $_SESSION['basket'] = $current_items;
    var_dump($_SESSION);
    echo "</br>";
    var_dump($_POST);
    header("Location: index.php");
?>
