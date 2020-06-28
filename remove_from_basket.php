<?php
    session_start();
    if (!$_SESSION['basket']) {
        $_SESSION['basket'] = [];
    }
    //$_SESSION['basket'] = null;
    $current_items = $_SESSION['basket'];
    //var_dump($_SESSION);
    //echo "</br>";
    //var_dump($_POST);
    foreach ($current_items as $k => $v) {
        if ($v === $_POST['remove_product']) {
            unset($current_items[$k]);
            break;
        }
    }
    $_SESSION['basket'] = $current_items;
    header("Location: basket.php");
?>
